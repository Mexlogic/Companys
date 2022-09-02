<?php 
if(isset($_POST['delete'])){
    require_once 'connection.php';
    $conn = new connection();
    session_start();

    $companyid = $_POST["companyid"];
    $userid = $_POST["userid"];
    
    if ($_SESSION["id"] == $userid) {
        $sql = "delete from companies where companieid = ?";
        $stmt = $conn->getConnection()->prepare($sql);
        $stmt->bind_param("i", $companyid);
        $stmt->execute();
    }

    if($stmt){
        header("location: index.php");
    }
    else{
        header("location: index.php");
    }
}
?>
