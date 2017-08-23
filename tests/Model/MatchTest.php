<?php
namespace Eddypouw\FootballDataApi\Model;

use PHPUnit\Framework\TestCase;

class MatchTest extends TestCase
{
    public function testConstruct()
    {
        $match = new Match(
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
            1
        );
        self::assertEquals(new \DateTime("2017-08-13T12:30:00Z"), $match->getMatchDate());
        self::assertSame(161280, $match->getId());
        self::assertSame(1, $match->getMatchDay());
        self::assertSame(675, $match->getHomeTeamId());
        self::assertSame(666, $match->getAwayTeamId());
        self::assertSame(449, $match->getCompetitionId());
        self::assertSame(1, $match->getGoalsAwayTeam());
        self::assertSame(2, $match->getGoalsHomeTeam());
        self::assertSame(0, $match->getGoalsAwayTeamHalfTime());
        self::assertSame(0, $match->getGoalsHomeTeamHalfTime());
        self::assertSame('Feyenoord Rotterdam', $match->getHomeTeamName());
        self::assertSame('FC Twente Enschede', $match->getAwayTeamName());
        self::assertSame('FINISHED', $match->getStatus());
    }

}