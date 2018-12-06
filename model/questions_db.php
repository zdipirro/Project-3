<?php
class Questions {
  public static function checkSession($email) {
    global $db;
    $query = "SELECT id, email, fname, lname FROM accounts WHERE email = :email";
    $stmt = $db->prepare($query, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $session_email = $_SESSION['email'];
    $execute = $stmt->execute(array(':email' => $session_email));
    return $execute;
  }
  
  public static function getInfo($email) {
    global $db;
    $query = "SELECT email, fname, lname, id FROM accounts WHERE email = :email";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':email', $email);
    $stmt->execute();
    $name = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $name;
  }
  
  public static function getQCount($email) {
    global $db;
    $queryq = "SELECT owneremail, title, body, skills FROM questions WHERE owneremail =:email";
    $stmtq = $db->prepare($queryq);
    $stmtq->bindValue(':email', $email);
    $stmtq->execute();
    $ques = $stmtq->fetchAll();
    $count = $stmtq->rowCount();
    $stmtq->closeCursor();
    return $count;
  }
  
  public static function getQuestions($email) {
    global $db;
    $queryq = "SELECT * FROM questions WHERE owneremail =:email";
    $stmtq = $db->prepare($queryq);
    $stmtq->bindValue(':email', $email);
    $stmtq->execute();
    $ques = $stmtq->fetchAll();
    $stmtq->closeCursor();
    return $ques;
  }
  
  public static function deleteProduct($ques_id) {
    global $db;
    $queryd = 'DELETE FROM questions WHERE id = :ques_id';
    $statement = $db->prepare($queryd);
    $statement->bindValue(':ques_id', $ques_id);
    $statement->execute();
    $statement->closeCursor();
    }
}







?>