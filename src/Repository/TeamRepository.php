<?php
declare(strict_types=1);
namespace Eddypouw\FootballDataApi\Repository;

use Eddypouw\FootballDataApi\Model\Team;
use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

class TeamRepository
{
    const URI = 'teams/';

    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function findById(int $id): ?Team
    {
        $response = $this->client->request('GET', sprintf('%s%d', self::URI, $id));
        return $this->createFromResponse($response);
    }

    private function createFromResponse(ResponseInterface $response): ?Team
    {
        $entity = json_decode($response->getBody()->getContents(), true);

        if (key_exists('error', $entity)) {
            return null;
        }

        preg_match_all('/\d+/', $entity['_links']['self']['href'], $numbers);
        $id = end($numbers[0]);

        return new Team((int) $id, $entity['shortName'], $entity['name'], $entity['crestUrl'], $entity['code']);
    }
}