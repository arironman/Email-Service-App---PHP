<?php


// This file handling the post request from signup form

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Check if username is empty
    $first_name = trim($_POST["first-name"]);
    $last_name = trim($_POST["last-name"]);
    $gender = trim($_POST["gender"]);
    $dob = trim($_POST["dob"]);
    $email = trim($_POST["email"])."@email.com";
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm-password"]);

    $error = '';

    // checking for password match
    if ($password != $confirm_password){
        $error = 'Password Could Not Match. Try Again!';
        header("location: ./signUp.php?msg=" . $error);
    }



    // checking that email exist or not
    if (emailExists($email)) {
        $error = 'Email Already Exists. Try Again';
        header("location: ./signUp.php?msg=".$error);
    
    }

    // checking for blank data
    if (empty($first_name) || empty($last_name) || empty($dob) || empty($gender) || empty($dob) || empty($email) || empty($password)){
        $error = 'Invalid Data. Try Again!';
        header("location: ./signUp.php?msg=" . $error);
    }

    if ($error == ''){
        $sql = "INSERT INTO `user` (`first_name`, `last_name`, `gender`, `dob`, `email`, `password`) VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssssss", $first_name, $last_name, $gender, $dob, $email, $password);

            // Try to execute this statement
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                $message = "Accoount Create Successfully!";
                
            } else {
                echo "Something went wrong";
            }
        }
        mysqli_stmt_close($stmt);
    }


    }


?>