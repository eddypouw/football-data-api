<?php
namespace Eddypouw\FootballDataApi\Repository;

use Eddypouw\FootballDataApi\Model\Competition;
use Eddypouw\FootballDataApi\Model\Match;
use Eddypouw\FootballDataApi\Model\Team;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

class MatchRepositoryTest extends TestCase
{
    private $client;
    /**
     * @var MatchRepository
     */
    private $match_repository;
    protected function setUp()
    {
        $this->client = $this->prophesize(Client::class);
        $this->match_repository = new MatchRepository($this->client->reveal());
    }

    public function testFindById()
    {
        $response = $this->prophesize(ResponseInterface::class);
        $stream   = $this->prophesize(StreamInterface::class);

        $response->getBody()->willReturn($stream);
        $this->client->request('GET', 'fixtures/161280')->willReturn($response);

        $stream->getContents()->willReturn(
            '{
                "fixture": {
                    "_links": {
                        "awayTeam": {
                            "href": "http://api.football-data.org/v1/teams/666"
                        },
                        "competition": {
                            "href": "http://api.football-data.org/v1/competitions/449"
                        },
                        "homeTeam": {
                            "href": "http://api.football-data.org/v1/teams/675"
                        },
                        "self": {
                            "href": "http://api.football-data.org/v1/fixtures/161280"
                        }
                    },
                    "awayTeamName": "FC Twente Enschede",
                    "date": "2017-08-13T12:30:00Z",
                    "homeTeamName": "Feyenoord Rotterdam",
                    "matchday": 1,
                    "odds": null,
                    "result": {
                        "goalsAwayTeam": 1,
                        "goalsHomeTeam": 2,
                        "halfTime": {
                            "goalsAwayTeam": 1,
                            "goalsHomeTeam": 1
                        }
                    },
                    "status": "FINISHED"
                }
            }'
        );

        $expected_match = new Match(
            161280,
            new \DateTime("2017-08-13T12:30:00Z"),
            "FC Twente Enschede",
            "Feyenoord Rotterdam",
            "FINISHED",
            1,
            675,
            666,
            449,
            2,
            1,
            1,
            1
        );

        self::assertEquals($expected_match, $this->match_repository->findById(161280));
    }

    public function testFindByCompetition()
    {
        $competition = $this->prophesize(Competition::class);
        $response = $this->prophesize(ResponseInterface::class);
        $stream   = $this->prophesize(StreamInterface::class);

        $competition->getId()->willReturn(101);
        $response->getBody()->willReturn($stream);
        $this->client->request('GET', 'competitions/101/fixtures/')->willReturn($response);

        $stream->getContents()->willReturn(
            '{
                "_links": {
                    "competition": {
                        "href": "http://api.football-data.org/v1/competitions/444"
                    },
                    "self": {
                        "href": "http://api.football-data.org/v1/competitions/444/fixtures"
                    }
                },
                "count": 1,
                "fixtures": [
                    {
                        "_links": {
                            "awayTeam": {
                                "href": "http://api.football-data.org/v1/teams/1766"
                            },
                            "competition": {
                                "href": "http://api.football-data.org/v1/competitions/444"
                            },
                            "homeTeam": {
                                "href": "http://api.football-data.org/v1/teams/1783"
                            },
                            "self": {
                                "href": "http://api.football-data.org/v1/fixtures/158193"
                            }
                        },
                        "awayTeamName": "Atl\u00e9tico Mineiro",
                        "date": "2017-05-13T19:00:00Z",
                        "homeTeamName": "EC Flamengo",
                        "matchday": 1,
                        "odds": null,
                        "result": {
                            "goalsAwayTeam": 1,
                            "goalsHomeTeam": 1,
                            "halfTime": {
                                "goalsAwayTeam": 0,
                                "goalsHomeTeam": 1
                            }
                        },
                        "status": "FINISHED"
                    }
                ]
            }'
        );

        $expected_match = new Match(
            158193,
            new \DateTime("2017-05-13T19:00:00Z"),
            "Atlético Mineiro",
            "EC Flamengo",
            "FINISHED",
            1,
            1783,
            1766,
            444,
            1,
            1,
            1,
            0
        );

        self::assertEquals([$expected_match], $this->match_repository->findByCompetition($competition->reveal()));
    }
}