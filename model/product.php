<?php
require_once '../../config.php';
require_once '../../lib/DatabaseModel.php';
class Product extends DatabaseModel
{
    // property
    protected $productID;
    protected $productCode;
    protected $productName;
    protected $qty;
    protected $price;
    protected $dateInStock;
    protected $categoryID;
    // table name
    protected static $tableName = "product";
    // all fields in tabel
    protected $tableFields = array(
        'productCode',
        'productName',
        'qty',
        'price',
        'dateInStock',
        'categoryID'
    );
    public function __construct($productCode, $productName, $qty, $price, $dateInStock, $categoryID, $productID="")
    {
        $this->productCode = $productCode;
        $this->productName = $productName;
        $this->qty = $qty;
        $this->price = $price;
        $this->dateInStock = $dateInStock;
        $this->categoryID = $categoryID;
        $this->productID = $productID;
    }
    public static function retrieveAllProductsByCategoryID($categoryID)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT *  FROM product WHERE categoryID='$categoryID'");
        if($sql->execute()){
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    public static function updateProductQty($qty,$productID)
    {
        global $dbh;
        $sql = $dbh->prepare("UPDATE product SET qty = '$qty' WHERE productID = '$productID'");
        if($sql->execute()){
            return TRUE;
        }else{
            return FALSE;
        }
    }
}
