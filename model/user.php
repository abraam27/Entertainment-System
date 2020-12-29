<?php
require_once 'config.php';
require_once 'lib/DatabaseModel2.php';
class User extends DatabaseModel2
{
    // property
    protected $userID;
    protected $username;
    protected $password;
    protected $type;
    // table name
    protected static $tableName = "user";
    // all fields in tabel
    protected $tableFields = array(
        'username',
        'password',
	'type'
    );
    public function __construct($username, $password, $type, $userID="")
    {
        $this->username = $username;
        $this->password = $password;
	$this->type = $type;
        $this->userID = $userID;
    }
    public static function UserLogin($username,$password)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT * from user WHERE username = '$username' AND password = '$password'");
        $sql->execute();
        $user = $sql->fetch(PDO::FETCH_ASSOC);
        return $user;
    }
}
