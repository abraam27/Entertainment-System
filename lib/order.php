<?php
require_once '../../config.php';
class Order
{
    // property
    private $orderID;
    private $orderCode;
    private $date;
    private $time;
    private $noOfItems;
    private $totalPrice;
    private $orderType;
    private $soldierID;
    
    public function __construct($orderCode, $date, $time, $noOfItems, $totalPrice, $orderType, $soldierID="", $orderID="")
    {
        $this->orderCode = $orderCode;
        $this->date = $date;
        $this->time = $time;
        $this->noOfItems = $noOfItems;
        $this->totalPrice = $totalPrice;
        $this->orderType = $orderType;
        $this->soldierID = $soldierID;
        $this->orderID = $orderID;
    }
    public function addOrder()
    {
        global $dbh;
        $sql = $dbh->prepare("INSERT INTO `order` (orderCode,date,time,noOfItems,totalPrice,orderType) VALUES ('$this->orderCode','$this->date','$this->time','$this->noOfItems','$this->totalPrice','$this->orderType')");
        if($sql->execute()){
            return $dbh->lastInsertId();
        }else{
            return FALSE;
        }
    }
    public function addOrderBySoldierID()
    {
        global $dbh;
        $sql = $dbh->prepare("INSERT INTO `order` (orderCode,date,time,noOfItems,totalPrice,orderType,soldierID) VALUES ('$this->orderCode','$this->date','$this->time','$this->noOfItems','$this->totalPrice','$this->orderType','$this->soldierID')");
        if($sql->execute()){
            return $dbh->lastInsertId();
        }else{
            return FALSE;
        }
    }
    public static function retrieveAllOrders()
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM `order` ORDER BY `orderID` DESC");
        // execute sql query
        $sql->execute();
        // fetch data to specfic format like associative array
        $orders = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $orders;
    }
    public static function retrieveAllOrdersByOrderType($orderType)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM `order` WHERE orderType = '$orderType' ORDER BY `orderID` DESC");
        // execute sql query
        $sql->execute();
        // fetch data to specfic format like associative array
        $orders = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $orders;
    }
    public static function deleteOrderByID($orderID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("DELETE FROM `order` WHERE orderID='$orderID'");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public static function retreiveOrderByID($orderID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT * FROM `order` WHERE orderID='$orderID'");
        $sql->execute();
        $order = $sql->fetch(PDO::FETCH_ASSOC);
        return $order;
    }
}
