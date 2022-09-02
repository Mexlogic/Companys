<?php 
function getCompanys() {
    require_once 'connection.php'; 
    require_once 'companie.php';
    $conn = new connection(); 

    $sql = "SELECT * FROM companies order by userid";
    $stmt = $conn->getConnection()->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();
    $fetchArr = $result->fetch_all();
    $companyArr = array();

    foreach ($fetchArr as $tmpcompany) {
        $company = new companie($tmpcompany[0],$tmpcompany[1],$tmpcompany[2],$tmpcompany[3],$tmpcompany[4],$tmpcompany[5],$tmpcompany[6]);                    
        $companyArr[] = $company;
    }
    return $companyArr;
}
?>