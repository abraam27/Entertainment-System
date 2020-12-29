<?php
require_once '../../config.php';
class Soldier
{
    // property, attrs, fields, member vars
    private $soldierID;
    private $SSN;
    private $militaryNo;
    private $soldierName;
    private $address;
    private $district;
    private $city;
    private $phoneNo1;
    private $phoneNo2;
    private $maritalStatus;
    private $bloodGroup;
    private $religion;
    private $degree;
    private $battalionNo;
    private $dateOfBirth;
    private $dateOfRecruitment;
    private $dateOfLayoffs;
    private $code;
    private $tmam;
    // behavior, member function, method, action
    public function __construct($SSN, $militaryNo, $soldierName, $address, $district, $city, $phoneNo1, $phoneNo2, $maritalStatus, $bloodGroup, $religion, $degree, $battalionNo, $dateOfBirth, $dateOfRecruitment, $dateOfLayoffs, $code, $tmam, $soldierID="")
    {
        $this->SSN = $SSN;
        $this->militaryNo = $militaryNo;
        $this->soldierName = $soldierName;
        $this->address = $address;
        $this->district = $district;
        $this->city = $city;
        $this->phoneNo1 = $phoneNo1;
        $this->phoneNo2 = $phoneNo2;
        $this->maritalStatus = $maritalStatus;
        $this->bloodGroup = $bloodGroup;
        $this->religion = $religion;
        $this->degree = $degree;
        $this->battalionNo = $battalionNo;
        $this->dateOfBirth = $dateOfBirth;
        $this->dateOfRecruitment = $dateOfRecruitment;
        $this->dateOfLayoffs = $dateOfLayoffs;
        $this->code = $code;
        $this->tmam = $tmam;
        $this->soldierID = $soldierID;
    }
    public function addSoldier()
    {
        global $dbh;
        $sql = $dbh->prepare("INSERT INTO soldier (SSN,militaryNo,soldierName,address,district,city,phoneNo1,phoneNo2,maritalStatus,bloodGroup,religion,degree,battalionNo,dateOfBirth,dateOfRecruitment,dateOfLayoffs,code,tmam) VALUES ('$this->SSN','$this->militaryNo','$this->soldierName','$this->address','$this->district','$this->city','$this->phoneNo1','$this->phoneNo2','$this->maritalStatus','$this->bloodGroup','$this->religion','$this->degree','$this->battalionNo','$this->dateOfBirth','$this->dateOfRecruitment','$this->dateOfLayoffs','$this->code','$this->tmam')");
        if($sql->execute()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function editSoldier()
    {
        global $dbh;
        $sql = $dbh->prepare("UPDATE soldier SET SSN='$this->SSN', militaryNo='$this->militaryNo', soldierName='$this->soldierName', address='$this->address', district='$this->district', city='$this->city', district='$this->district', city='$this->city', phoneNo1='$this->phoneNo1', phoneNo2='$this->phoneNo2', maritalStatus='$this->maritalStatus', bloodGroup='$this->bloodGroup', religion='$this->religion', degree='$this->degree', battalionNo='$this->battalionNo', dateOfBirth='$this->dateOfBirth', dateOfRecruitment='$this->dateOfRecruitment', dateOfLayoffs='$this->dateOfLayoffs', code='$this->code', tmam='$this->tmam' WHERE soldierID='$this->soldierID'");
        if($sql->execute()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public static function retreiveAllSoldiers()
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM soldier ORDER BY soldierID DESC");
        // execute sql query
        $sql->execute();
        // fetch data to specfic format like associative array
        $allSoldiers = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allSoldiers;
    }
    public static function retreiveSoldierByID($soldierID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM soldier WHERE soldierID='$soldierID'");
        $sql->execute();
        $soldier = $sql->fetch(PDO::FETCH_ASSOC);
        return $soldier;
    }
    public static function retreiveSoldierByCode($code)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM soldier WHERE code='$code'");
        $sql->execute();
        $soldier = $sql->fetch(PDO::FETCH_ASSOC);
        return $soldier;
    }
    public static function deleteSoldierById($soldierID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("DELETE FROM soldier WHERE soldierID='$soldierID'");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
}
