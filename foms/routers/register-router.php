<?php
include '../includes/connect.php';
$name = htmlspecialchars($_POST['name']);
$username = htmlspecialchars($_POST['username']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$phone = $_POST['phone'];


$nameErr = $emailErr = $phoneErr = "";

$flag=true;

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

if (empty($_POST["name"]))
{
    $flag=false;
}
else
{
    if (!preg_match("/^[a-zA-Z-']*$/",$name))
    {
      //$nameErr = "Only letters and white space allowed";
      $flag=false;
    }
}
if(empty($_POST["email"]))
{
  //$emailErr = "valid Email address";
  $flag=false;
} 
else
{
 
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
  {
    //$emailErr = "The email address is incorrect";
    $flag=false;
  }
}  
if (empty($_POST["phone"]))
{
  //$phoneErr = "Enter phone number";
  $flag=false;
}
else
{
  if(!preg_match("/^[6-9][0-9]{9}$/",$phone))
  {
    //$phoneErr = "Enter valid phone number";
    $flag=false;
  }
}
if($flag)
{
    $sql = "INSERT INTO users (name, username, password, contact) VALUES ('$name', '$username', '$password', $phone);";
    if($con->query($sql)==true){
    $user_id =  $con->insert_id;
    $sql = "INSERT INTO wallet(customer_id) VALUES ($user_id)";
    if($con->query($sql)==true){
        $wallet_id =  $con->insert_id;
        $cc_number = htmlspecialchars($_POST['number']);
        $cvv_number = htmlspecialchars($_POST['cvv']);
        $sql = "INSERT INTO wallet_details(wallet_id, number, cvv) VALUES ($wallet_id, $cc_number, $cvv_number)";
        $con->query($sql);
    }
    }
    header("location: ../login.php");
}
else
{
    header("location: ../register.php");
}




$sql = "INSERT INTO users (name, username, password, contact) VALUES ('$name', '$username', '$password', $phone);";
if($con->query($sql)==true){
$user_id =  $con->insert_id;
$sql = "INSERT INTO wallet(customer_id) VALUES ($user_id)";
if($con->query($sql)==true){
	$wallet_id =  $con->insert_id;
	$cc_number = htmlspecialchars($_POST['number']);
	$cvv_number = htmlspecialchars($_POST['cvv']);
	$sql = "INSERT INTO wallet_details(wallet_id, number, cvv) VALUES ($wallet_id, $cc_number, $cvv_number)";
	$con->query($sql);
}
}
header("location: ../login.php");
}
?>