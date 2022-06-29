<?php

include('connect.php');
session_start();

if (isset($_POST['submit'])) {

  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = $_POST['password'];


  $filename = $_FILES['img']['name'];
  $Photos = "Photos/" . basename($filename);
  $img = 'http://localhost/socialMedia/Photos/' . $filename;

  move_uploaded_file($_FILES['img']['tmp_name'], $Photos);

  $sql = "SELECT * FROM `user` WHERE `name` = '$name'";

  $result = mysqli_query($conn, $sql);


  if ($row = mysqli_num_rows($result) > 0) {
    $message = "<h6>" . "Name already excist" . "</h6>";
  } else {

    if (empty($name) || empty($email) || empty($password) || empty($filename)) {
      $message = "<h6>" . "please fill all fields" . "</h6>";
    } else {

      $query = "INSERT INTO `user`( `name`,`email`, `password`,`img`,`date`) VALUES ('$name','$email','$password','$img','" . date("Y-m-d") . '' . date("H:i:s", STRTOTIME(date('h:i:sa'))) . "')";
      $query_result = mysqli_query($conn, $query);

      if ($query_result) {

        $user_sql = "SELECT * FROM `user` WHERE `name` = '$name'";

        $user_result = mysqli_query($conn, $user_sql);

        while ($user_row = mysqli_fetch_assoc($user_result)) {

          $_SESSION['id'] = $user_row['id'];

          header('location:login.php');

          $message = "<h6>" . "Sign Up successfully" . "</h6>";
        }
      }
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
  <title>Sign up</title>
</head>

<body>
  <main class="form-signin">
    <form action="signup.php" method="POST" enctype="multipart/form-data">
      <a href="">
        <h1 class="brand">Social Media</h1>
      </a>
      <h1 class="h3 mb-3 fw-normal">Register Now</h1>

      <div class="form-floating">
        <input type="text" class="form-control" name="name" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Name</label>
      </div>
      <div class="form-floating">
        <input type="email" class="form-control" name="email" id="floatingInput" placeholder="name">
        <label for="floatingInput">Email address</label>
      </div>
      <div class="form-floating">
        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
      </div>
      <div class="form-floating">
        <input class="form-control" type="file" name="img" id="formFile">
      </div>
      <div class="checkbox mb-3">
        <a class="linksignup" href="login.php">I Have Account Go to Login</a>
      </div>
      <button class="w-100 btn btn-lg btnLogin" type="submit" name="submit">Sign up</button>
      <!-- <?php echo $message;  ?> -->
    </form>
  </main>

  <!--Bootstrap 5 js-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>