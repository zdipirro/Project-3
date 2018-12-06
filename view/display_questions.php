<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);  
ini_set('display_errors' , 1);

$db = new PDO($dsn, $username, $password);
if ( $getUser > 0) {
    foreach ($getUser as $user) {
        $fname = $user['fname'];
        $lname = $user['lname'] . '<br>';
    }
}
else {
    echo ' Email does not exist';
}
?>
<!DOCTYPE html>
<html>

   <head>
      <title>Profile Page</title>
      <link type="text/css" rel="stylesheet" href="display_questions.css" />
   </head>
	
   <body>
   <center>
   <div class = "container">
   <div id = "menu">
   <a href="logout.php">Logout</a>
   </div>
   <table>
    <tr class="title">
        <td>Title</td><td>Body</td><td>Skills</td><td>&nbsp;</td><td>&nbsp;</td>

        <?php echo "Welcome ".$fname." ".$lname; foreach($getQuestions as $questions) {?>

        <tr>
        <td><?php echo $questions['title'];?></td>
        <td><?php echo $questions['body'];?></td>
        <td><?php echo $questions['skills'];?></td>
        <td>
            <form action ="" method= "post" >
                <input type="hidden" name="action" value="editQuestion">
                <input type="hidden" name="id" value="<?php echo $questions['id'];?>">
<!--                <input type="hidden" name="email" value="--><?php //echo $questions['owneremail'];?><!--">-->
<!--                <input type="hidden" name="title" value="--><?php //echo $questions['title'];?><!--">-->
<!--                <input type="hidden" name="skills" value="--><?php //echo $questions['skills'];?><!--">-->
<!--                <input type="hidden" name="body" value="--><?php //echo $questions['body'];?><!--">-->
                <input type="submit" value="EDIT">
            </form>
        </td>
        <td>
            <form action ="" method= "post" >
                <input type="hidden" name="action" value="deleteQuestion">
                <input type="hidden" name="id" value="<?php echo $questions['id'];?>">
                <input type="hidden" name="email" value="<?php echo $questions['owneremail'];?>">
                <input type="submit" value="DELETE">
            </form>
        </td>
    </tr>
    <?php }?>
   </table>
   <div class = "ask">
   <span><a href="index.php?action=display_new_question">Click here to ask a quesiton</a><br><br></span>
   </div>
   </div>
   </center>
   </body>
 
	
</html>
