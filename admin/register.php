<?php
include "db.php";
$success_message = "";
$firstname = $lastname = $email = $password = $confirm_password = "";

$errors =array('email' => '', 'firstname' => '', 'lastname'=> '', 'password'=> '', 'cpassword' => '', 'errors' => '');
if(isset($_POST['submit'])){
   
    if (empty($_POST['firstname'])) {
        $errors['firstname'] = "Firstname is required";
       
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["firstname"]))) {
        $errors['firstname'] = "Firstname can only contain letters, numbers, and underscores.";
    } else {
        $firstname =  $_POST['firstname'];
    }

    if (empty($_POST['lastname'])) {
        $errors['lastname'] = "Lastname is required";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["lastname"]))) {
        $errors['lastname'] = "Lastname can only contain letters, numbers, and underscores.";
    } else {
        $lastname =  $_POST['lastname'];
    }

    if (empty($_POST['email'])) {
        $errors['email'] = "An email is required";
    } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Email must be a valid email address";
    } else {
        $check_email = trim($_POST['email']);
        
        // Check if the email already exists
        $check_user_email_sql = "SELECT id from users Where email = '$check_email'";
        $check_email_result = $conn->query($check_user_email_sql);
        
        if ($check_email_result->num_rows == 1) {
            $errors['email'] = "User already taken";
        //    exit; // Exit script if email is already taken
        } else {
            $email = $check_email;
        }
    }
    

    if (empty($_POST['password'])) {
        $errors['password'] = "Password is required";
    } elseif (strlen(trim($_POST['password'])) < 6) {
        $errors['password'] = "Password must be at least 6 characters";
    } else {
        $password = trim($_POST['password']);
    }

    if (empty($_POST['cpassword'])) {
        $errors['cpassword'] = "Confirm Password is required";
    } else {
        $confirm_password = trim($_POST['cpassword']);
        if ($password != $confirm_password) {
            $errors['password'] = "Passwords did not match";
        }
    }


    if (empty($_POST['number'])) {
       echo "number is required";
    } elseif (!preg_match('/[0-9]+/', trim($_POST["number"]))) {
       echo "only numbers is allow.";
    } else {
       $num = $_POST['number'];
    }


    if (empty($firstname) || empty($lastname) || empty($email) || empty($password)  || empty($num)){
        $errors['errors'] = "Please fill in all required fields.";
    } else {
        $hashed_password  = password_hash($password, PASSWORD_DEFAULT);
        $insert_sql = "INSERT INTO users (firstname, lastname, email, password, numbers) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($insert_sql);
        $stmt->bind_param("sssss", $firstname, $lastname, $email, $hashed_password, $num);
        
        if ($stmt->execute()) {
            $success_message = "Registration successful! You can now log in.";
            header("refresh:3;url=login.php");
            //header("location: login.php");
          //  exit; // Exit after successful insertion
        } else {
            echo "Something went wrong";
        }
    }
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-primary"  style="background-image: url(pic.jpg); background-size: cover;">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Admin Registeration </h3>
                                    <?php if (!empty($success_message)): ?>
        <p><?php echo $success_message; ?></p>
    <?php endif; ?>
                                <span style="color:red"><?php echo $errors['errors'] ?></span>
                                </div>
                                    <div class="card-body" style="border-radius: 10px;">

                                        <form method="post" action="" >
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="firstname" id="inputFirstName" style="border-radius: 10px;" type="text" placeholder="Enter your first name" />
                                                        <label for="inputFirstName">First name</label>
                                                        <span><?php echo $errors['firstname'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" value="<?php echo $lastname ?>" name="lastname" id="inputLastName" type="text" placeholder="Enter your last name" />
                                                        <label for="inputLastName">Last name</label>
                                                        <span><?php echo $errors['lastname'] ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="email" id="inputEmail" style="border-radius: 10px;" type="email" placeholder="name@example.com" />
                                                <label for="inputEmail">Email address</label>
                                                <span><?php echo $errors['email'] ?></span>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="password" id="inputPassword" style="border-radius: 10px;" type="password" placeholder="Create a password" />
                                                        <label for="inputPassword">Password</label>
                                                        <span><?php echo $errors['password'] ?></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  name="cpassword" style="border-radius: 10px;" id="inputPasswordConfirm" type="password" placeholder="Confirm password" />
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                        <span><?php echo $errors['cpassword'] ?></span>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control"  name="number" style="border-radius: 10px;" id="inputPasswordConfirm" type="text" placeholder="Confirm number" />
                                                        <label for="inputPasswordConfirm">Confirm Password</label>
                                                        <span></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <input type="submit" name="submit" class="btn btn-primary btn-block" value="Create Account"></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; tru 2023</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>
