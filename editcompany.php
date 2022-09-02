<div class="modal fade" id="editmodal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Edit Entry</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <form method="POST" action="" enctype="multipart/form-data" id="main">              
            <div class="form-group">
                <input type="hidden" name="companyid" id="companyid">
            </div>
            <div class="form-group">
                <input type="hidden" name="userid" id="userid">
            </div>
            <div class="form-group">
                <label>Picture</label>
                <input type="file" name="avatar" class="form-control"/>
            </div>
            <div class="form-group">
                <label>Company</label>
                <input type="text" id="formcompany" name="company" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Contact</label>
                <input type="text" id="formcontact" name="contact" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Telephone</label>
                <input type="text" id="formtelephone" name="telephone" class="form-control" required>
            </div>            
            <div class="form-group col text-center" id="specialbutton">
              <button id="editbutton" type="submit" name="editcompany">Submit changes</button>
            </div> 
        </form>

        </div>
    </div>
  </div>
</div>

<script>
    function editbtn(value) {
      document.getElementById("userid").setAttribute('value', value.getAttribute("data-userid"));
      document.getElementById("companyid").setAttribute('value', value.getAttribute("data-companyid"));
      document.getElementById("formcompany").setAttribute('value', value.getAttribute("data-company"));
      document.getElementById("formcontact").setAttribute('value', value.getAttribute("data-contact"));
      document.getElementById("formtelephone").setAttribute('value', value.getAttribute("data-telephone"));
    }
</script>  

<?php 
  if(isset($_POST['editcompany'])){
    require_once 'connection.php';
    $conn = new connection();
    session_start();

    $companyid = $_POST["companyid"];
    $userid = $_POST["userid"];
    $company = $_POST["company"];
    $contact = $_POST["contact"];
    $telephone = $_POST["telephone"];
    
    if ($_SESSION["id"] == $userid) {
      if(!empty($_FILES["avatar"]["name"])) { 
        $fileName = basename($_FILES["avatar"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION);              
        $allowTypes = array('png'); 
        if(in_array($fileType, $allowTypes)){
          $image = file_get_contents($_FILES["avatar"]["tmp_name"]);
        }else {$image = null;}                                  
      }else {$image = null;}

      if ($image == null) {
        $sql = "update companies set company = ?, contactperson = ?, telephone = ? where companieid = ?";
        $stmt = $conn->getConnection()->prepare($sql);
        $stmt->bind_param("sssi", $company, $contact, $telephone, $companyid);
        $stmt->execute();
      } else {
        $sql = "update companies set company = ?, contactperson = ?, telephone = ?, avatar = ? where companieid = ?";
        $stmt = $conn->getConnection()->prepare($sql);
        $stmt->bind_param("ssssi", $company, $contact, $telephone, $image, $companyid);
        $stmt->execute();
      }     
    }
    if($stmt){
      header("location: index.php");
    }
    else{
      header("location: index.php");
    }
  }
?>