<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Verwaltung</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
  </script>
  <link rel="stylesheet" href="style.scss">
</head>

<body>
  <?php include "header.php"; ?>
  <main>
    <?php 
      require_once 'fetchcompanys.php';
      require_once 'companie.php';
      require_once 'editcompany.php';
      session_start();  
      if($_SESSION != null){
        include "editcard.php";
      }

      $companys = getCompanys();
      foreach($companys as $company) {
        echo 
        '<div class="card">';
          echo sprintf(
          '<img id="avatar" src="data:image/png;base64,%s" />', base64_encode($company->getAvatar()));
          echo 
          '<div>
            <h4><b>'. $company->getCompany(). '</b></h4>
            <p>Contact: '. $company->getContactPerson(). '</p>
            <p>Telephone: '. $company->getTelephone(). '</p>
          </div>';

          if ($_SESSION && $_SESSION['id'] == $company->getUserid()) {
            echo 
            '<p>Am '. $company->getCreated(). ' erstellt</p>';
            echo 
            '<div class="editbar"> 
              <div class="editbarbuttons">
            
                <button 
                id="editbutton" 
                onclick="editbtn(this)" 
                type="button" 
                data-bs-toggle="modal" 
                data-bs-target="#editmodal" 
                data-companyid="'.$company->getCompanyid().'" 
                data-userid="'.$company->getUserid().'" 
                data-company="'.$company->getCompany().'" 
                data-contact="'.$company->getContactPerson().'" 
                data-telephone="'.$company->getTelephone().'"
                >Edit</button>

                <form method="POST" action="deletecompany.php" type="hidden">
                  <input type="hidden" name="companyid" value="'.$company->getCompanyid().'">
                  <input type="hidden" name="userid" value="'.$company->getUserid().'">
                  <button id="editbutton" name="delete" type="submit">Delete</button>
                </form>
                    
              </div>
            </div>';
          }
        echo 
        '</div>';
      }
    ?>
  </main>
</body>
</html>