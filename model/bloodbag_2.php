<?php
require_once '../../config.php';
require_once '../../lib/DatabaseModel.php';
class BloodBag extends DatabaseModel
{
    // property
    protected $bloodBagID;
    protected $bloodGroup;
    protected $amount;
    protected $collectionDate;
    protected $expiryDate;
    protected $organizationID;
    // table name
    protected static $tableName = "bloodbag";
    // all fields in tabel
    protected $tableFields = array(
        'bloodGroup',
        'amount',
	'collectionDate',
        'expiryDate',
        'organizationID',
    );
    public function __construct($bloodGroup, $amount, $collectionDate, $expiryDate, $organizationID, $bloodBagID="")
    {
        $this->bloodGroup = $bloodGroup;
        $this->amount = $amount;
	$this->collectionDate = $collectionDate;
        $this->expiryDate = $expiryDate;
        $this->bloodBagID = $bloodBagID;
        $this->organizationID = $organizationID;
    }
    public static function retrieveAllBloodBagsOfOrganization($organizationID)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT *  FROM bloodbag WHERE organizationID='$organizationID' AND outDate IS NULL ORDER BY amount , bloodbagID ASC");
        if($sql->execute()){
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    public static function retrieveAllBloodBagsOfOrganizationByGroup($organizationID,$bloodGroup)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT *  FROM bloodbag WHERE organizationID = '$organizationID' AND bloodGroup = '$bloodGroup' AND outDate IS NULL ORDER BY amount , bloodbagID ASC");
        if($sql->execute()){
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    public static function deleteBloodBagByID($bloodBagID,$outDate)
    {
        global $dbh;
        $sql = $dbh->prepare("UPDATE bloodbag set outDate = ' $outDate ' where bloodBagID ='$bloodBagID'");
        if($sql->execute()){
            return TRUE;
        }else{
            return false;
        }
    }
    public static function retreiveAllBloodbagsAvailable($bloodGroup,$amount,$city,$type)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT *
            FROM bloodbag
            INNER JOIN organization ON bloodbag.organizationID=organization.organizationID
            WHERE bloodbag.bloodGroup='$bloodGroup' AND bloodbag.amount = '$amount' AND bloodbag.outDate IS NULL
            AND organization.city = '$city' AND organization.type = '$type'");
        if($sql->execute()){
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    public static function retreiveAllAvailableBloogBagsByOrganizationID($bloodGroup,$amount,$city,$type,$organizationID)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT *
            FROM bloodbag
            INNER JOIN organization ON bloodbag.organizationID=organization.organizationID
            WHERE bloodbag.bloodGroup='$bloodGroup' AND bloodbag.amount = '$amount' AND bloodbag.outDate IS NULL
            AND organization.city = '$city' AND organization.type = '$type' AND organization.organizationID = '$organizationID'");
        if($sql->execute()){
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    public static function retreiveAllOraganiztionIDsOfAvailableBloogBags($bloodGroup,$amount,$city,$type)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT DISTINCT bloodbag.organizationID
            FROM bloodbag
            INNER JOIN organization ON bloodbag.organizationID=organization.organizationID
            WHERE bloodbag.bloodGroup='$bloodGroup' AND bloodbag.amount = '$amount' AND bloodbag.outDate IS NULL
            AND organization.city = '$city' AND organization.type = '$type'");
        $sql->execute();
        $organizationData = $sql->fetchAll(PDO::FETCH_ASSOC);
        $allOrganizationId = null;
        if(is_array($organizationData) && count($organizationData)>0){
            foreach($organizationData as $organizationID):
                $allOrganizationId[] = $organizationID['organizationID'];
            endforeach;
        }
        return $allOrganizationId;
    }
    public static function retreiveAllBloodbagsNeededToExchange($bloodGroup,$amount,$bloodBankID,$numberOfBags)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT *  FROM bloodbag WHERE organizationID = '$bloodBankID' AND bloodGroup = '$bloodGroup' AND amount = '$amount' AND outDate IS NULL ORDER BY bloodbagID ASC limit ".$numberOfBags);
        if($sql->execute()){
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
}
