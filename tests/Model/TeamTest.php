<?php
namespace Eddypouw\FootballDataApi\Model;

use PHPUnit\Framework\TestCase;

class TeamTest extends TestCase
{
    public function testConstruct()
    {
        $team = new Team(675, 'Feyenoord', 'Feyenoord Rotterdam', 'https://feyenoord.nl/logo.png');
        self::assertSame('Feyenoord', $team->getShortName());
        self::assertSame('Feyenoord Rotterdam', $team->getName());
        self::assertSame('https://feyenoord.nl/logo.png', $team->getImageUrl());
        self::assertSame(675, $team->getId());
        self::assertNull($team->getCode());
    }
}
