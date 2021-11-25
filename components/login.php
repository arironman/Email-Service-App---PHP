<?php
// handling the user login 

require_once "config.php";

// if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);


    if (empty($email) || empty($password)) {
        $error = "Invalid Data. Try Again!";
        header("location: ../index.php?msg=".$error);

    } 


    // checking for @email.com is given in email
    if (!strpos($email, '@email.com')) {
        $email .= '@email.com';
    }

    if (empty($error)) {
        $sql = "SELECT email, password FROM user WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);


        // Try to execute this statement
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            mysqli_stmt_bind_result($stmt, $orignal_email, $orignal_password);
            if (mysqli_stmt_fetch($stmt)) {
                if ($password == $orignal_password) {
                    // this means the password is corrct. Allow user to login
                    session_start();
                    $_SESSION["email"] = $email;
                    $_SESSION["id"] = $id;
                    $_SESSION["loggedin"] = true;

                    //Redirect user to welcome page
                    header("location: ../index.php");
                }else{
                    $error = 'Wrong Password. Try Again!';
                    header("location: ../index.php?msg=" . $error);

                }
            }
            else{
                $error = 'Invalid Email. Create Account First';
                header("location: ../index.php?msg=" . $error);
            }

        }
        else{
            $error = 'Invalid Email. Create Account First';
            header("location: ../index.php?msg=".$error);

        }
    }
}