<?php
require_once '../../config.php';
require_once '../../lib/DatabaseModel.php';
class Payment extends DatabaseModel
{
    // property
    protected $paymentID;
    protected $soldierID;
    protected $ta2reshaAmount;
    // table name
    protected static $tableName = "payment";
    // all fields in tabel
    protected $tableFields = array(
        'soldierID',
        'ta2reshaAmount'
    );
    public function __construct($soldierID, $ta2reshaAmount, $paymentID="")
    {
        $this->soldierID = $soldierID;
        $this->ta2reshaAmount = $ta2reshaAmount;
        $this->paymentID = $paymentID;
    }
    public static function deletePaymentBySoldierID($soldierID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("DELETE FROM payment WHERE soldierID='$soldierID'");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public static function retreivePaymentBySoldierID($soldierID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM payment WHERE soldierID='$soldierID'");
        $sql->execute();
        $payment = $sql->fetch(PDO::FETCH_ASSOC);
        return $payment;
    }
    public static function updateTa2reshaAmount($ta2reshaAmount,$soldierID)
    {
        global $dbh;
        $sql = $dbh->prepare("UPDATE payment SET ta2reshaAmount = '$ta2reshaAmount' WHERE soldierID = '$soldierID'");
        if($sql->execute()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}