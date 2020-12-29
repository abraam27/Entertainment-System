<?php
require_once '../../config.php';
require_once '../../lib/DatabaseModel.php';
class Orderdetails extends DatabaseModel
{
    // property
    protected $orderdetailsID;
    protected $productID;
    protected $qty;
    protected $orderID;
    // table name
    protected static $tableName = "orderdetails";
    // all fields in tabel
    protected $tableFields = array(
        'productID',
        'qty',
        'orderID',
    );
    public function __construct($productID, $qty, $orderID, $orderdetailsID="")
    {
        $this->productID = $productID;
        $this->qty = $qty;
        $this->orderID = $orderID;
        $this->orderdetailsID = $orderdetailsID;
    }
    public static function deleteProductByID($productID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("DELETE FROM orderdetails WHERE productID='$productID'");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public static function retreiveDetailsByOrderID($orderID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM orderdetails WHERE orderID='$orderID'");
        $sql->execute();
        $orderdetails = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $orderdetails;
    }
    public static function deleteOrderDetailsByOrderID($orderID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("DELETE FROM orderdetails WHERE orderID='$orderID'");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
}
