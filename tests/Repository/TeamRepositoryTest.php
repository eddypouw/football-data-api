<?php
namespace Eddypouw\FootballDataApi\Repository;

use Eddypouw\FootballDataApi\Model\Team;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class TeamRepositoryTest extends TestCase
{
    private $client;
    /**
     * @var TeamRepository
     */
    private $team_repository;
    protected function setUp()
    {
        $this->client = $this->prophesize(Client::class);
        $this->team_repository = new TeamRepository($this->client->reveal());
    }

    public function testFindById()
    {
        $response = $this->prophesize(ResponseInterface::class);
        $stream   = $this->prophesize(StreamInterface::class);

        $response->getBody()->willReturn($stream);
        $this->client->request('GET', 'teams/675')->willReturn($response);

        $stream->getContents()->willReturn(
            '{
                "_links": {
                    "fixtures": {
                        "href": "http://api.football-data.org/v1/teams/675/fixtures"
                    },
                    "players": {
                        "href": "http://api.football-data.org/v1/teams/675/players"
                    },
                    "self": {
                        "href": "http://api.football-data.org/v1/teams/675"
                    }
                },
                "code": null,
                "crestUrl": "http://upload.wikimedia.org/wikipedia/de/2/24/Logo_Feyenoord_Rotterdam.svg",
                "name": "Feyenoord Rotterdam",
                "shortName": null,
                "squadMarketValue": null
            }'
        );

        $expected_competition = new Team(
            675,
            '',
            "Feyenoord Rotterdam",
            "http://upload.wikimedia.org/wikipedia/de/2/24/Logo_Feyenoord_Rotterdam.svg"
        );

        self::assertEquals($expected_competition, $this->team_repository->findById(675));
    }
}