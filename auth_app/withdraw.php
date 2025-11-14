<!DOCTYPE html>
<html>
<head>
    <title>Withdraw</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h3>Withdraw Money</h3>
    <?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>

    <form method="post">
        <input type="number" name="amount" class="form-control mb-3" placeholder="Enter amount" required>
        <button type="submit" name="withdraw" class="btn btn-danger">Withdraw</button>
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
    $q = $conn->query("SELECT balance FROM users WHERE id = $user_id");
    $current_balance = $q->fetch_assoc()['balance'];

    if(isset($_POST['withdraw'])){
        $amount = $_POST['amount'];

        if($amount>0 && $amount <= $current_balance){
            $conn->query("UPDATE    users SET balance = balance - $amount WHERE id=$user_id");
             $conn->query("INSERT INTO transactions(user_id, type, amount) 
                      VALUES($user_id, 'Withdraw', $amount)");
                      header("Location: dashboard.php");
        exit();
        }else{
            $error = "Insufficient Balance!";
        }
    
}














?>


