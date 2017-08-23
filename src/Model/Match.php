<?php
declare(strict_types=1);
namespace Eddypouw\FootballDataApi\Model;

class Match
{
    /**
     * @var \DateTime
     */
    private $match_date;

    /**
     * @var string
     */
    private $away_team_name;

    /**
     * @var string
     */
    private $home_team_name;

    /**
     * @var string
     */
    private $status;

    /**
     * @var int
     */
    private $match_day;

    /**
     * @var int
     */
    private $goals_home_team;

    /**
     * @var int
     */
    private $goals_away_team;

    /**
     * @var int
     */
    private $goals_home_team_half_time;

    /**
     * @var int
     */
    private $goals_away_team_half_time;

    /**
     * @var int
     */
    private $home_team_id;

    /**
     * @var int
     */
    private $away_team_id;

    /**
     * @var int
     */
    private $competition_id;

    /**
     * @var int
     */
    private $id;

    public function __construct(
        int $id,
        \DateTime $match_date,
        string $away_team_name,
        string $home_team_name,
        string $status,
        int $match_day,
        int $home_team_id,
        int $away_team_id,
        int $competition_id,
        int $goals_home_team = null,
        int $goals_away_team = null,
        int $goals_home_team_half_time = null,
        int $goals_away_team_half_time = null
    ) {
        $this->match_date                = $match_date;
        $this->away_team_name            = $away_team_name;
        $this->home_team_name            = $home_team_name;
        $this->status                    = $status;
        $this->match_day                 = $match_day;
        $this->goals_home_team           = $goals_home_team ?: 0;
        $this->goals_away_team           = $goals_away_team ?: 0;
        $this->goals_home_team_half_time = $goals_home_team_half_time ?: 0;
        $this->goals_away_team_half_time = $goals_away_team_half_time ?: 0;
        $this->home_team_id              = $home_team_id;
        $this->away_team_id              = $away_team_id;
        $this->competition_id            = $competition_id;
        $this->id                        = $id;
    }

    public function getMatchDate(): \DateTime
    {
        return $this->match_date;
    }

    public function getAwayTeamName(): string
    {
        return $this->away_team_name;
    }

    public function getHomeTeamName(): string
    {
        return $this->home_team_name;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getMatchDay(): int
    {
        return $this->match_day;
    }

    public function getGoalsHomeTeam(): int
    {
        return $this->goals_home_team;
    }

    public function getGoalsAwayTeam(): int
    {
        return $this->goals_away_team;
    }

    public function getGoalsHomeTeamHalfTime(): int
    {
        return $this->goals_home_team_half_time;
    }

    public function getGoalsAwayTeamHalfTime(): int
    {
        return $this->goals_away_team_half_time;
    }

    public function getCompetitionId(): int
    {
        return $this->competition_id;
    }

    public function getHomeTeamId(): int
    {
        return $this->home_team_id;
    }

    public function getAwayTeamId(): int
    {
        return $this->away_team_id;
    }

    public function getId(): int
    {
        return $this->id;
    }
}
