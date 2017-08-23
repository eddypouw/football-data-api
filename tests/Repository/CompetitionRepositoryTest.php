<?php
namespace Eddypouw\FootballDataApi\Repository;

use Eddypouw\FootballDataApi\Model\Competition;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class CompetitionRepositoryTest extends TestCase
{
    private $client;
    /**
     * @var CompetitionRepository
     */
    private $competition_repository;
    protected function setUp()
    {
        $this->client = $this->prophesize(Client::class);
        $this->competition_repository = new CompetitionRepository($this->client->reveal());
    }

    public function testFindById()
    {
        $response = $this->prophesize(ResponseInterface::class);
        $stream   = $this->prophesize(StreamInterface::class);

        $response->getBody()->willReturn($stream);
        $this->client->request('GET', 'competitions/449')->willReturn($response);

        $stream->getContents()->willReturn(
            '{
                "_links": {
                    "fixtures": {
                        "href": "http://api.football-data.org/v1/competitions/449/fixtures"
                    },
                    "leagueTable": {
                        "href": "http://api.football-data.org/v1/competitions/449/leagueTable"
                    },
                    "self": {
                        "href": "http://api.football-data.org/v1/competitions/449"
                    },
                    "teams": {
                        "href": "http://api.football-data.org/v1/competitions/449/teams"
                    }
                },
                "caption": "Eredivisie 2017/18",
                "currentMatchday": 3,
                "id": 449,
                "lastUpdated": "2017-08-23T04:00:08Z",
                "league": "DED",
                "numberOfGames": 306,
                "numberOfMatchdays": 34,
                "numberOfTeams": 18,
                "year": "2017"
            }'
        );

        $expected_competition = new Competition(
            449,
            "Eredivisie 2017/18",
            "DED",
            34,
            18,
            306,
            "2017",
            3,
            new \DateTime("2017-08-23T04:00:08Z")
        );

        self::assertEquals($expected_competition, $this->competition_repository->findById(449));
    }
}