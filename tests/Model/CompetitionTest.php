<?php
namespace Eddypouw\FootballDataApi\Model;

use PHPUnit\Framework\TestCase;

class CompetitionTest extends TestCase
{
    public function testConstruct()
    {
        $competition = new Competition(
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

        self::assertEquals(new \DateTime("2017-08-23T04:00:08Z"), $competition->getLastUpdated());
        self::assertSame(449, $competition->getId());
        self::assertSame("Eredivisie 2017/18", $competition->getName());
        self::assertSame("DED", $competition->getLeague());
        self::assertSame(34, $competition->getMatchDays());
        self::assertSame(18, $competition->getTeamCount());
        self::assertSame(306, $competition->getGameCount());
        self::assertSame(3, $competition->getCurrentMatchDay());
        self::assertSame('2017', $competition->getYear());
    }
}
