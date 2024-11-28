<?php
require_once 'classes/Database.php';
require_once 'classes/Vote.php';
require_once 'classes/Employee.php';

// Connect to the database
$db = (new Database())->connect();
$vote = new Vote($db);

// Get form data
$voter_id = $_POST['voter_id'];
$nominee_id = $_POST['nominee_id'];
$category = $_POST['category'];
$comment = $_POST['comment'];

// Validate the form data
if (empty($voter_id) || empty($nominee_id) || empty($category) || empty($comment)) {
    echo "Error: All fields are required.";
    exit;
}

// Ensure the voter isn't voting for themselves
if ($voter_id == $nominee_id) {
    echo "Error: You cannot vote for yourself.";
    exit;
}

// Submit the vote
if ($vote->submitVote($voter_id, $nominee_id, $category, $comment)) {
    header("Location: index.php?message=success");
    exit;
} else {
    header("Location: index.php?message=error");
    exit;
}

?>

