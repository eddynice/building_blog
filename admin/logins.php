<?php
session_start();

require_once "login.php";

$email = $password = "";
$email_err = $password_err = $login_err = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter email.";
    } else {
        $email = trim($_POST["email"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($email_err) && empty($password_err)) {
        $param_email = mysqli_real_escape_string($conn, $email);

        $sql = "SELECT id, email, password FROM user WHERE email = '$param_email'";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $hashed_password = $row['password'];

                if (password_verify($password, $hashed_password)) {
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $row['id'];
                    $_SESSION["email"] = $email;
                    header("location: index.php");
                    exit;
                } else {
                    $login_err = "Incorrect password.";
                }
            } else {
                $login_err = "Email does not exist.";
            }
        } else {
            $login_err = "Something went wrong.";
        }
    }
    
    mysqli_close($conn);
}
?>

<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/login.css">
</head>
<body style="background-image: url(img/img2.jpg);">
  <div class="container">
    <div class="right">
      <form action="" method="POST" enctype="multipart/form-data">
        <div class="img">
          <img src="img/About1.jpg" alt="" style="width: 60px; border-radius: 30px;">
        </div>
        <h2>Admin Page</h2>
        <div class="text">
          <input type="text" placeholder="Email" name="email">
          <span style="color:red"><?php echo $email_err; ?></span>
        </div>
        <div class="text">
          <input type="password" placeholder="Password" name="password">
          <span style="color:red"><?php echo $password_err; ?></span>
        </div>
        <div class="submit" id="submit">
          <input type="submit" value="Submit" name="submit" style="background-color: rgb(24, 119, 242); font-size: 17px; width: 100%; padding: 14px 16px; border-radius: 20px; cursor: pointer;">
          <span style="color:red"><?php echo $login_err; ?></span>
        </div>
        <div class="bot">
          <a href="" target="_blank" rel="noopener noreferrer" style="color: rgb(0, 68, 255);">Forgot password?</a> or <a href="Signup.php" rel="noopener noreferrer" style="color: rgb(0, 68, 255);">Sign up</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
