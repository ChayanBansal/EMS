<?php 
session_start();
/*$course_id=$_SESSION['course_id'];
$semester=$_SESSION['semester'];
$from_year=$_SESSION['from_year'];*/

$host="sql12.freemysqlhosting.net";
$user="sql12213993";
$pass="iqpTsClsCq";
$db="sql12213993";

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// prepare and bind
/*
$stmt = $conn->prepare("INSERT INTO MyGuests (firstname, lastname, email) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $firstname, $lastname, $email);

// set parameters and execute
$firstname = "John";
$lastname = "Doe";
$email = "john@example.com";
$stmt->execute();
*/
//getting subjects
$get_student_list = $conn->prepare("SELECT roll_id FROM roll_list WHERE semester=? AND enrol_no=?");
$get_student_list->bind_param('is',$semester,$enrol_no);

$semester=3;
$enrol_no='2016AB001022';
$get_student_list->execute();
if($get_student_list->num_rows()>0)
{
    echo('success');
}

?>