<?php  
class Companie {
    private $companieid, $userid, $company, $contactperson, $telephone, $created, $avatar;

    function __construct($companieid, $userid, $company, $contactperson, $telephone, $created, $avatar) {
        $this->companieid = $companieid;
        $this->userid = $userid;   
        $this->company = $company;
        $this->contactperson = $contactperson;
        $this->telephone = $telephone;
        $this->created = $created;
        $this->avatar = $avatar;
    }

   function getCompanyid() {
    return $this->companieid;
   }
    
   function setCompanieid($companieid) {
    $this-> companieid = $companieid;
   }

   function getUserid() {
    return $this->userid;
   }
   
   function setUserid($userid) {
    $this-> userid = $userid;
   }

   function getCompany() {
    return $this->company;
   }
   
   function setCompany($company) {
    $this-> company = $company;
   }

   function getContactPerson() {
    return $this->contactperson;
   }
   
   function setContactPerson($contactperson) {
    $this-> contactperson = $contactperson;
   }

   function getTelephone() {
    return $this->telephone;
   }

   function setTelephone($telephone) {
    $this-> telephone = $telephone;
   }

   function getCreated() {
    return $this->created;
   }

   function setCreated($created) {
    $this-> created = $created;
   }

   function getAvatar() {
    return $this->avatar;
   }
    
   function setAvatar($avatar) {
    $this-> avatar = $avatar;
   }
}
?>