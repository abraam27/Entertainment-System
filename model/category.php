<?php
require_once '../../config.php';
require_once '../../lib/DatabaseModel.php';
class Category extends DatabaseModel
{
    // property
    protected $categoryID;
    protected $categoryName;
    protected $categoryType;
    // table name
    protected static $tableName = "category";
    // all fields in tabel
    protected $tableFields = array(
        'categoryName',
        'categoryType'
    );
    public function __construct($categoryName, $categoryType, $categoryID="")
    {
        $this->categoryName = $categoryName;
        $this->categoryType = $categoryType;
        $this->categoryID = $categoryID;
    }
    public static function retrieveAllCategoriesByProductID($productID)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT *  FROM category WHERE productID='$productID'");
        if($sql->execute()){
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    public static function retrieveAllCategoriesByCategoryType($categoryType)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT *  FROM category WHERE categoryType='$categoryType'");
        if($sql->execute()){
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }else{
            return false;
        }
    }
    public static function retrieveCategoryTypeByCategoryID($categoryID)
    {
        // get connection
        global $dbh;
        $sql = $dbh->prepare("SELECT categoryType FROM category WHERE categoryID='$categoryID'");
        $sql->execute();
        $category = $sql->fetch(PDO::FETCH_ASSOC);
        if(is_array($category)){
            return $category['categoryType'];
        }else{
            return false;
        }
    }
    public static function deleteAllProductByCategoryID($categoryID)
    {
        global $dbh;
        $sql = $dbh->prepare("DELETE FROM product WHERE categoryID = '$categoryID'");
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
}
