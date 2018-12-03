<?php 
include("model/accounts_db.php");
include("model/database.php");
include("model/questions_db.php");

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
  $action = filter_input(INPUT_GET, 'action');
  if ($action == NULL) {
    $action = 'display_login';
  }
}

if ($action == 'display_login') {
  include("view/login_view.php");
}

elseif ($action == 'register') {
  include("view/reg_view.php");
}

if ($action == 'login') {
  $db = new PDO($dsn, $username, $password);
  $email = filter_input(INPUT_POST, 'email');
  $pass = filter_input(INPUT_POST, 'password');
  $passlength = strlen($pass);


  if (empty($email)) {
    header('Location: index.php?feedback=You forgot to enter your e-mail');
  }

  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    header('Location: index.php?feedback=Invalid Email');
  }
  
  if (empty($pass)) {
    header('Location: index.php?feedback=Missing Password');
  }

  else {
    if ($passlength < 8) {
      header('Location: index.php?feedback=Password must be at least 8 characters long');
    }
  }


  $f = new Accounts();
  $user = $f->GetUser($email);
  if ($user == false) {
    echo "This email has not yet been registered into our system<br><br>";
    echo '<a href="https://web.njit.edu/~ztd2/IS-218-Project-1/view/reg_view.php">Click   here to register</a><br><br>'; 
    echo 'If you wish to go back to the login page, <a href="https://web.njit.edu/~ztd2/IS-218-Project-1/index.php">Click here</a>';
  }
  else {
  session_start();
  $_SESSION['email'] = $email;
  include("profile.php");
  }
  
}
?>