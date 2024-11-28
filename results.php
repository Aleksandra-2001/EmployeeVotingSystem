<?php
require_once 'classes/Database.php';
require_once 'classes/Vote.php';
require_once 'classes/Employee.php';

$db = (new Database())->connect();
$vote = new Vote($db);

$results = $vote->getResults();
$topVoters = $vote->getTopVoters();

echo "<h1>Voting Results</h1>";
foreach ($results as $result) {
    echo "<p>Category: {$result['category']} - Nominee ID: {$result['nominee_id']} - Votes: {$result['vote_count']}</p>";
}

echo "<h2>Top Voters</h2>";
foreach ($topVoters as $voter) {
    echo "<p>Voter ID: {$voter['voter_id']} - Votes Cast: {$voter['votes_count']}</p>";
}
?>
