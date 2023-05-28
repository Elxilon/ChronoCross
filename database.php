<?php
// connexion à la BDD
$host = "localhost:3307"; $username = "root"; $password = "password"; $dbname = "chronocross";
$conn = mysqli_connect($host, $username, $password, $dbname);

// récupère les données dans la BDD
$currentRaceQuery = "SELECT * FROM races WHERE start_time <= NOW() AND end_time IS NULL LIMIT 1";
$currentRaceResult = mysqli_query($conn, $currentRaceQuery);
$currentRace = mysqli_fetch_assoc($currentRaceResult);

// récupère les courses en cours
$upcomingRacesQuery = "SELECT * FROM races WHERE start_time > NOW() ORDER BY start_time ASC";
$upcomingRacesResult = mysqli_query($conn, $upcomingRacesQuery);
$upcomingRaces = array();
while ($row = mysqli_fetch_assoc($upcomingRacesResult)) {
  $upcomingRaces[] = $row;
}

// récupère les résultats
$currentRaceResultsQuery = "SELECT * FROM results WHERE race_id = {$currentRace['id']} ORDER BY finish_time ASC";
$currentRaceResultsResult = mysqli_query($conn, $currentRaceResultsQuery);
$currentRaceResults = array();
while ($row = mysqli_fetch_assoc($currentRaceResultsResult)) {
  $currentRaceResults[] = $row;
}

// crée une réponse
$response = array(
  "current_race" => $currentRace,
  "upcoming_races" => $upcomingRaces,
  "current_race_results" => $currentRaceResults
);

// envoi la réponse au JSON
header("Content-Type: application/json");
echo json_encode($response);
