<!DOCTYPE html>
<html>
<head>
    <title>Deposit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3>Deposit Money</h3>
    <form method="post">
        <input type="number" name="amount" class="form-control mb-3" placeholder="Enter amount" required>
        <button type="submit" name="deposit" class="btn btn-success">Deposit</button>
        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </form>
</div>

</body>
</html>



<?php 
session_start();
include "db.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if(isset($_POST['deposit'])){
    $amount = $_POST['amount'];

    if($amount > 0){

        // Update balance
        $conn->query("UPDATE users SET balance = balance + $amount WHERE id = $user_id");

        // Insert into correct table
        $conn->query("INSERT INTO transactions (user_id, type, amount) 
                      VALUES ($user_id, 'Deposit', $amount)");

        header("Location: dashboard.php");
        exit();
    }
}
?>
