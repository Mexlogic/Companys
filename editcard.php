<div class="card" id="editcard">
  <form method="POST" action="" enctype="multipart/form-data" id="main">              
    <div class="form-group">
      <label>Picture</label>
      <input type="file" name="choosefile" class="form-control" value=""/>
    </div>
    <div class="form-group">
      <label>Company</label>
      <input type="text" name="company" class="form-control" placeholder="Company" required>
    </div>
    <div class="form-group">
      <label>Contact</label>
      <input type="text" name="contact" class="form-control" placeholder="Contact" required>
    </div>
    <div class="form-group">
      <label>Telephone</label>
      <input type="text" name="telephone" class="form-control" placeholder="Telephone" required>
    </div>
    <div class="form-group col text-center" id="specialbutton">
      <button id="editbutton" type="submit" name="submitcompany">Add</button>
    </div>   
  </form>
</div>

<?php
    require_once "connection.php";

    if(isset($_POST['submitcompany']) && $_SESSION != null){
        $userid = $_SESSION["id"];
        $company = $_POST["company"];
        $contact = $_POST["contact"];
        $telephone = $_POST["telephone"];
        $created = date("Y-m-d");
                
        if(!empty($_FILES["choosefile"]["name"])) { 
            $fileName = basename($_FILES["choosefile"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION);              
            $allowTypes = array('png'); 
            if(in_array($fileType, $allowTypes)){
                $image = file_get_contents($_FILES["choosefile"]["tmp_name"]);
            }else {$image = null;}                                  
        }
       
        $conn = new connection();
        
        $sql = "insert into companies (userid, company, contactperson, telephone, created, avatar) values (?,?,?,?,?,?)";
        $stmt = $conn->getConnection()->prepare($sql);
        $stmt->bind_param("isssss", $userid, $company, $contact, $telephone, $created, $image);
        $stmt->execute();
    }
    ?>