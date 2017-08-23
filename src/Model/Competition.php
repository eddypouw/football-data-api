<?php
declare(strict_types=1);
namespace Eddypouw\FootballDataApi\Model;

class Competition
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $league;

    /**
     * @var int
     */
    private $match_days;

    /**
     * @var int
     */
    private $team_count;

    /**
     * @var string
     */
    private $year;

    /**
     * @var int
     */
    private $current_match_day;

    /**
     * @var \DateTime
     */
    private $last_updated;

    /**
     * @var int
     */
    private $game_count;

    public function __construct(
        int $id,
        string $name,
        string $league,
        int $match_days,
        int $team_count,
        int $game_count,
        string $year,
        int $current_match_day,
        \DateTime $last_updated
    ) {
        $this->id                = $id;
        $this->name              = $name;
        $this->league            = $league;
        $this->match_days        = $match_days;
        $this->team_count        = $team_count;
        $this->year              = $year;
        $this->current_match_day = $current_match_day;
        $this->last_updated      = $last_updated;
        $this->game_count        = $game_count;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLeague(): string
    {
        return $this->league;
    }

    public function getMatchDays(): int
    {
        return $this->match_days;
    }

    public function getTeamCount(): int
    {
        return $this->team_count;
    }

    public function getYear(): string
    {
        return $this->year;
    }

    public function getCurrentMatchDay(): int
    {
        return $this->current_match_day;
    }

    public function getLastUpdated(): \DateTime
    {
        return $this->last_updated;
    }

    public function getGameCount(): int
    {
        return $this->game_count;
    }
}
