<?php
include('connect.php');
session_start();

if (isset($_POST['submit'])) {
  $email = $_POST['email'];
  $password = $_POST['password'];

  $sql = "SELECT * FROM `user` WHERE `email` = '$email' AND `password` = '$password'";

  $result = mysqli_query($conn, $sql);

  if ($row = mysqli_num_rows($result) > 0) {

    while ($user_row = mysqli_fetch_assoc($result)) {

      $_SESSION['id'] = $user_row['id'];

      header('location:home.php');

      $message = "<h6>" . "Login Success" . "</h6>";
    }
  } else {
    if (empty($email) || empty($password)) {
      $message = "<h6>" . "please fill all fields" . "</h6>";
    } else {
      $message = "<h6>" . "Email or Password doesn't match" . "</h6>";
    }
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Bootstrap 5 css-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!--font-awesome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <!--style-->
  <link rel="stylesheet" href="css/style.css">
  <title>login</title>
</head>

<body>
  <main class="form-signin">
    <form action="login.php" method="POST">
      <a href="">
        <h1 class="brand">Social Media</h1>
      </a>
      <h1 class="h3 mb-3 fw-normal">Please Login</h1>

      <div class="form-floating">
        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>

      <div class="checkbox mb-3">
        <a class="linksignup" href="signup.php">sign up</a>
      </div>
      <button class="w-100 btn btn-lg btnLogin" type="submit" name="submit">Login</button>
    </form>
    <!-- <?php echo $message;  ?> -->
  </main>

  <!--Bootstrap 5 js-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>