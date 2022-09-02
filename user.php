<?php
class user {
   private $username, $email, $password;

   function __construct($username, $email, $password) {  
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
   }

   public function submit() {
      $conn = new connection();

      if($this->checkusername()) {
         $message = "Username already exists";
         echo "<script type='text/javascript'>alert('$message');</script>";
      } else if($this->checkemail()) {
         $message = "Email already registered";
         echo "<script type='text/javascript'>alert('$message');</script>";
      } else {
         $sql = "Insert into users (username, email, password) values (?,?,?)";
         $stmt = $conn->getConnection()->prepare($sql);
         $result = $stmt->execute([$this->username, $this->email, $this->password]);
         if($result){
            $message = "User successfully created";
            echo "<script type='text/javascript'>alert('$message');</script>";
         }else{
            $message = "Failed to create user";
            echo "<script type='text/javascript'>alert('$message');</script>";
         }                   
      }       
   }

   private function checkusername() {
      $conn = new connection();
      $username = $this->username;
    
      $sql = "Select username from users where username = ?";
      $stmt = $conn->getConnection()->prepare($sql);
      $stmt->bind_param("s", $username);
      $stmt->execute();
      $result = $stmt->get_result();
      $userarr = $result->fetch_all();
      if($userarr != null) {    
        return true;
      } else {
        return false;    
      } 
    }
    
   private function checkemail() {
      $conn = new connection();
      $email = $this->email;
    
      $sql = "Select email from users where email = ?";
      $stmt = $conn->getConnection()->prepare($sql);
      $stmt->bind_param("s", $email);
      $stmt->execute();
      $result = $stmt->get_result();
      $emailarr = $result->fetch_all();
      if($emailarr != null) {    
        return true;
      } else {
        return false;    
      }
    }

   function getName() {
    return $this->name;
   }

   function getEmail() {
    return $this->email;
   }

   function getPassword() {
    return $this->password;
   }

   function setName($username) {
    $this-> name = $username;
   }

   function setEmail($email) {
    $this-> email = $email;
   }

   function setPassword($password) {
    $this-> password = $password;
   }
}
?>