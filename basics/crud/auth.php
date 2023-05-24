<?php

include 'DbConnect/connection.php';
session_start();

$_SESSION['loggedin'] = false;
$error = false;

if(isset($_SESSION['email'])){
    header('Location: index.php');
    exit();
}

if(isset($_POST['email'])){
    $Email = $_POST['email'];
    $Password = $_POST['password'];

    $Email = mysqli_real_escape_string($con, $Email);
    $Password = mysqli_real_escape_string($con, $Password);

    $sql = "SELECT * FROM `registered_user` WHERE Email = ? AND Password = ?";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("ss", $Email, $Password);
    $stmt->execute();
    $result = $stmt->get_result();
    $count = $result->num_rows;

    if($count == 1){
        $row = $result->fetch_assoc();

        $_SESSION['email'] = $Email;
        $_SESSION['UserName'] = $row['UserName'];
        $_SESSION['loggedin'] = true;

        header('Location: index.php');
        exit();
    }
    header('Location: auth.php?id=0');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Example</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="//cdn.rawgit.com/necolas/normalize.css/master/normalize.css">
    <link rel="stylesheet" href="//cdn.rawgit.com/milligram/milligram/master/dist/milligram.min.css">
    <style>
        body {
            margin-top: 30px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="column column-60 column-offset-20">
            <h2>Simple Auth Example</h2>
        </div>
    </div>
    <div class="row">
        <div class="column column-60 column-offset-20">

            <?php
            //echo sha1("rabbit")."<br/>";
            if ( true == $_SESSION['loggedin'] ) {
                echo "Hello Admin, Welcome!";
            } else {
                echo "Hello Stranger, Login Below";
            }
            ?>
        </div>
    </div>
    <div class="row" style="margin-top:100px;">
        <div class="column column-60 column-offset-20">
            <?php
            if ( $error ) {
                echo "<blockquote>Username and Password didn't match</blockquote>";
            }
            if ( false == $_SESSION['loggedin'] ):
                ?>
                <form method="POST">
                    <label for=username>Email</label>
                    <input type="text" name='email' id="email">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password">
                    <button type="submit" class="button-primary" name="submit">Log In</button>
                </form>
            <?php
            else:
                ?>
                <form action="auth.php" method="POST">
                    <input type="hidden" name="logout" value="1">
                    <button type="submit" class="button-primary" name="submit">Log Out</button>
                </form>
            <?php
            endif;
            ?>
        </div>
    </div>
</div>