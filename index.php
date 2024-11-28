<?php
require_once 'classes/Database.php';
require_once 'classes/Database.php';
require_once 'classes/Employee.php';

$db = (new Database())->connect();
$employee = new Employee($db);
$employees = $employee->getEmployees();

// Simulate logged-in user for testing purposes
$voter_id = 1; // Replace with the actual logged-in user's ID in a real application
?>

<?php if (isset($_GET['message'])): ?>
    <div class="alert <?= $_GET['message'] == 'success' ? 'alert-success' : 'alert-danger'; ?> mt-3">
        <?= $_GET['message'] == 'success' ? 'Your vote has been submitted successfully! Thank you for participating.' : 'An error occurred while submitting your vote. Please try again later.'; ?>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Employee Appreciation Voting</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h1>Employee Appreciation Voting</h1>
    <form action="submit_vote.php" method="POST">
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category" id="category" class="form-control" required>
                <option value="Select category">-- Select category --</option>
                <option value="Makes Work Fun">Makes Work Fun</option>
                <option value="Team Player">Team Player</option>
                <option value="Culture Champion">Culture Champion</option>
                <option value="Difference Maker">Difference Maker</option>
            </select>
        </div>
        <div class="form-group">
            <label for="nominee">Nominee</label>
            <select name="nominee_id" id="nominee" class="form-control" required>
                <option value="">-- Select an Employee --</option>
                <?php foreach ($employees as $employee): ?>
                    <?php if ($employee['id'] !== $voter_id): // Exclude voter from nominee list ?>
                        <option value="<?= $employee['id'] ?>"><?= htmlspecialchars($employee['name']) ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea name="comment" id="comment" class="form-control" required></textarea>
        </div>
        <input type="hidden" name="voter_id" value="<?= $voter_id ?>"> <!-- Pass voter ID -->
        <button type="submit" class="btn btn-primary">Submit Vote</button>
    </form>
    
</div>
</body>
</html>
