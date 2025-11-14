<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Banking System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php 
    session_start();
    include 'db.php';

    if(!isset($_SESSION['user_id'])){
        header("Location:login.php");
        exit();
    }
    $user_id = $_SESSION['user_id'];
    $q = $conn->query("SELECT * FROM users WHERE id = $user_id");
    $user = $q->fetch_assoc();


?>

<div class="container mt-5">
    <h2>Welcome, <?= $user['username']; ?> 👋</h2>
    <h4>Your Balance: <b>₹<?= $user['balance']; ?></b></h4>

    <hr>

    <a href="deposit.php" class="btn btn-success">Deposit Money</a>
    <a href="withdraw.php" class="btn btn-danger">Withdraw Money</a>
    <a href="history.php" class="btn btn-primary">Transaction History</a>
    <a href="login.php" class="btn btn-secondary float-end">Logout</a>
</div>

</body>
</html>