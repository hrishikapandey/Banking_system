<?php 
session_start();
include 'db.php';

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $check = $conn->prepare("SELECT id FROM users WHERE email=? OR username=?");
    $check->bind_param("ss",$email,$username);
    $check->execute();
    $check->store_result();

    if($check->num_row>0){
        echo "<script>alert('User already exist');</script>";
    }else{
        $hashed_password = password_hash($password,PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO users (username,email,password) VALUES (?,?,?)");
        $stmt->bind_param("sss",$username,$email,$hashed_password);

        if($stmt->execute()){
            echo "<script>alert('Registration successful! You can now login.');window.location.href='login.php';</script>";

        }else{
            echo "Error:" . $stmt->error;
        }


    }


}









?>

































<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-5">
      <div class="card shadow-sm">
        <div class="card-header text-center bg-primary text-white">
          <h3>Register</h3>
        </div>
        <div class="card-body">
          <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
          <form method="POST">
            <div class="mb-3">
              <label class="form-label">Username</label>
              <input type="text" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Register</button>
          </form>
          <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>