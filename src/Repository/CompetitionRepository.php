<?php
declare(strict_types=1);
namespace Eddypouw\FootballDataApi\Repository;


use Eddypouw\FootballDataApi\Model\Competition;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class CompetitionRepository
{
    const URI = 'competitions/';

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function findById(int $id): ?Competition
    {
        $response = $this->client->request('GET', sprintf('%s%d', self::URI, $id));
        return $this->createFromResponse($response);
    }

    private function createFromResponse(ResponseInterface $response): ?Competition
    {
        $entity = json_decode($response->getBody()->getContents(), true);

        if (key_exists('error', $entity)) {
            return null;
        }

        return new Competition(
            $entity['id'],
            $entity['caption'],
            $entity['league'],
            $entity['numberOfMatchdays'],
            $entity['numberOfTeams'],
            $entity['numberOfGames'],
            $entity['year'],
            $entity['currentMatchday'],
            new \DateTime($entity['lastUpdated'])
        );
    }
}