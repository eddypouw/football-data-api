<?php
require_once('vendor/autoload.php');

$client    = new \GuzzleHttp\Client(['base_uri' => 'https://api.football-data.org/v1/']);
$match_api = new \Eddypouw\FootballDataApi\Repository\MatchRepository($client);
$team_api  = new \Eddypouw\FootballDataApi\Repository\TeamRepository($client);

$match = $match_api->findById(161280);
$team  = $team_api->findById($match->getHomeTeamId());

print $team->getName() . "\n";
print $team->getShortName() . ' ' . $team->getImageUrl() . "\n";

$team  = $team_api->findById($match->getAwayTeamId());

print $team->getName() . "\n";
print $team->getShortName() . ' ' . $team->getImageUrl() . "\n";