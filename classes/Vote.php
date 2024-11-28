<?php
class Vote {
    private $conn;
    private $table = 'votes';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function submitVote($voter_id, $nominee_id, $category, $comment) {
        if ($voter_id == $nominee_id) {
            return "You cannot vote for yourself!";
        }
        $query = "INSERT INTO " . $this->table . " (voter_id, nominee_id, category, comment, timestamp)
                  VALUES (:voter_id, :nominee_id, :category, :comment, NOW())";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':voter_id', $voter_id);
        $stmt->bindParam(':nominee_id', $nominee_id);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':comment', $comment);
        if ($stmt->execute()) {
            return "Vote submitted successfully!";
        }
        return "Error submitting vote.";
    }

    public function getResults() {
        $query = "SELECT nominee_id, category, COUNT(*) as vote_count 
                  FROM " . $this->table . " 
                  GROUP BY nominee_id, category
                  ORDER BY category, vote_count DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTopVoters() {
        $query = "SELECT voter_id, COUNT(*) as votes_count 
                  FROM " . $this->table . " 
                  GROUP BY voter_id
                  ORDER BY votes_count DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
