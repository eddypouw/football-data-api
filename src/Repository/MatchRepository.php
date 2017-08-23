<?php
declare(strict_types=1);
namespace Eddypouw\FootballDataApi\Repository;

use Eddypouw\FootballDataApi\Model\Competition;
use Eddypouw\FootballDataApi\Model\Match;
use GuzzleHttp\Client;

class MatchRepository
{
    const URI = 'fixtures/';

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function findById(int $id): ?Match
    {
        $response = $this->client->request('GET', sprintf('%s%d', self::URI, $id));
        return $this->createFromResponse(json_decode($response->getBody()->getContents(), true)['fixture']);
    }

    /**
     * @param Competition $competition
     * @return Match[]
     */
    public function findByCompetition(Competition $competition): array
    {
        $response = $this->client->request('GET', sprintf('competitions/%d/%s', $competition->getId(),self::URI));

        $matches = [];
        foreach (json_decode($response->getBody()->getContents(), true)['fixtures'] as $match) {
            $matches[] = $this->createFromResponse($match);
        }

        return $matches;
    }

    private function createFromResponse(array $entity): ?Match
    {
        if (key_exists('error', $entity)) {
            return null;
        }

        preg_match_all('/\d+/', $entity['_links']['homeTeam']['href'], $numbers);
        $home_team_id = end($numbers[0]);

        preg_match_all('/\d+/', $entity['_links']['self']['href'], $numbers);
        $id = end($numbers[0]);

        preg_match_all('/\d+/', $entity['_links']['awayTeam']['href'], $numbers);
        $away_team_id = end($numbers[0]);

        preg_match_all('/\d+/', $entity['_links']['competition']['href'], $numbers);
        $competition_id = end($numbers[0]);

        $goals_home_half_time = null;
        $goals_away_half_time = null;
        if (key_exists('halfTime', $entity['result'])) {
            $goals_home_half_time = $entity['result']['halfTime']['goalsHomeTeam'];
            $goals_away_half_time = $entity['result']['halfTime']['goalsAwayTeam'];
        }

        return new Match(
            (int) $id,
            new \DateTime($entity['date']),
            $entity['awayTeamName'],
            $entity['homeTeamName'],
            $entity['status'],
            $entity['matchday'],
            (int) $home_team_id,
            (int) $away_team_id,
            (int) $competition_id,
            $entity['result']['goalsHomeTeam'],
            $entity['result']['goalsAwayTeam'],
            $goals_home_half_time,
            $goals_away_half_time
        );
    }
}