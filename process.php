<?php

session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'dbpeople';

$mysqli = new mysqli($host, $user, $pass, $db) or die(mysqli_error($mysqli));


$id = 0;
$update = false;
$fname = '';
$lname = '';
$email = '';


//create
if (isset($_POST['save'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];

    $mysqli->query("INSERT INTO `tblcrud` (`fname`, `lname`, `email`)
    VALUES ('$fname', '$lname', '$email')") or die($mysqli->error);

    header("location: index.php");

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";
}
//delete
elseif (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $mysqli->query("DELETE FROM tblcrud WHERE id=$id") or die(mysqli_error($mysqli));

    header("location: index.php");

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";
}

//search
elseif (isset($_GET['edit'])) {
    $id = $_GET['edit'];

    $update = true;
    $result = $mysqli->query("SELECT * FROM `tblcrud` WHERE id='$id'") or die(mysqli_error($mysqli));
    $ar = array($result);
    if (count($ar) == 1) {
        $row = $result->fetch_array();
        $fname = $row['fname'];
        $lname = $row['lname'];
        $email = $row['email'];
    }
}

//update
elseif (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $lname = $_POST['email'];

    $mysqli->query("UPDATE tblcrud SET `fname`='$fname', `lname`='$lname', `email`='$email' WHERE id = '$id'")
        or die($mysqli->error);

    $_SESSION['message'] = "Record has been updated";
    $_SESSION['msg_type'] = "warning";

    header('location: index.php');
}
