<?php
require_once '../../config.php';
require_once '../../lib/DatabaseModel.php';
class Cart extends DatabaseModel
{
    // property
    protected $cartID;
    protected $productID;
    protected $qty;
    // table name
    protected static $tableName = "cart";
    // all fields in tabel
    protected $tableFields = array(
        'productID',
        'qty'
    );
    public function __construct($productID, $qty, $cartID="")
    {
        $this->productID = $productID;
        $this->qty = $qty;
        $this->cartID = $cartID;
    }
    public static function updateQtyInCart($cartID,$qty)
    {
        global $dbh;
        $sql = $dbh->prepare("UPDATE cart SET qty = '$qty' WHERE cartID='$cartID'");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public static function emptyCart()
    {
        global $dbh;
        $sql = $dbh->prepare("DELETE FROM cart");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
}