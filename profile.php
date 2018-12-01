<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

include("model/database.php");
include("model/questions_db.php");

$db = new PDO($dsn, $username, $password);
?>
<!DOCTYPE html>
<html>

   <head>
      <title>Profile Page</title>
      <link type="text/css" rel="stylesheet" href="profile.css" />
   </head>
	
   <body>
   <center>
   <?php
     session_start();
     $email = $_SESSION['email'];
     $f = new Questions();
     $sesh = $f->checkSession($email);
     if(isset($_SESSION['email'])) {
   ?> 
   <div id = "container">
   <?php
     if($sesh > 0) {
       $f = new Questions();
       $info = $f->getInfo($email);
       $first = $info['fname'];
       $last = $info['lname'];
       $email = $info['email'];
       $id = $info['id'];
       $session_email = $_SESSION['email'];
     
       }
       else {
         echo "The username doesn't exist. Maybe the session was modified";
       }
     }
     else {
       echo "Session username was not set";
     }
      
   ?>
   <div id = "menu">
   <a href="logout.php">Logout</a>
   </div>
   <div id = "profile">
     <?php echo $first." ".$last."'s Profile"; ?>
   </div> 
   <div class = "questions">
     <h1>Submitted Question History</h1><br />
     <?php
     if($session_email == $_SESSION['email']) {
       $f = new Questions();
       $count = $f->getQCount($email);
     if ($count > 0) {
       $f = new Questions();
       $ques = $f->getQuestions($email);
       $num = 0;
       $array = array();
       while ($num < $count) {
         $array[] = implode(",", $ques[$num]);
         $qnum=1;
         $sum = $qnum + $num;
         echo "Question #".$sum."<br><br>Title: ".$ques[$num]['title']."<br>";
         echo "Body: ".$ques[$num]['body']."<br>";
         echo "Skills: ".$ques[$num]['skills']."<br><br>";
         $num+=1;
       }
       ?>
       <?php
     }
     else {
       $title = "N/A";
       $body = "N/A";
       $skills = "N/A";
     }
     }
     else {
       echo "Session username was not set";
     }
    ?>
   <div class = "ask">
   <span><a href="https://web.njit.edu/~ztd2/IS-218-Project-1/view/ques_view.php">Click here to ask a quesiton</a><br><br></span>
   </div>
   </div>
   </div>
   </center>
   </body>
 
	
</html>
