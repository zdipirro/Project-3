<!DOCTYPE html>
<html>
<body>
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

include ("model/database.php");
require ("model/accounts_db.php");

$db = new PDO($dsn, $username, $password);
$email = filter_input(INPUT_POST, 'email');
$pass = filter_input(INPUT_POST, 'password');
$passlength = strlen($pass);


if (empty($email)) {
  header('Location: login.php?feedback=You forgot to enter your e-mail');
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  header('Location: login.php?feedback=Invalid Email');
}
  
if (empty($pass)) {
  header('Location: login.php?feedback=Missing Password');
}

else {
  if ($passlength < 8) {
    header('Location: login.php?feedback=Password must be at least 8 characters long');
  }
}


$f = new Accounts();
$user = $f->GetUser($email);
if ($user == false) {
  echo "This email has not yet been registered into our system<br><br>";
  echo '<a href="https://web.njit.edu/~ztd2/IS-218-Project-1/view/reg_view.php">Click here to register</a><br><br>'; 
  echo 'If you wish to go back to the login page, <a href="https://web.njit.edu/~ztd2/IS-218-Project-1/index.php">Click here</a>';
}
else {
session_start();
$_SESSION['email'] = $email; 
header('Location: profile.php'); 
}


?>
</body>
</html>