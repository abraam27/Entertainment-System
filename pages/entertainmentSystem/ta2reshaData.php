<?php
require_once '../../config.php';

function retreiveTa2reshaData($code)
{
    global $dbh;
    $sql = $dbh->prepare("SELECT * FROM soldier WHERE code = '$code'");
    $sql->execute();
    $soldier = $sql->fetch(PDO::FETCH_ASSOC);
    $soldierID = $soldier['soldierID'];
    $sql = $dbh->prepare("SELECT * FROM payment WHERE soldierID = '$soldierID'");
    $sql->execute();
    $payment = $sql->fetch(PDO::FETCH_ASSOC);
    if(is_numeric($payment['ta2reshaAmount'])){
        echo '<tbody>
            <tr>
                <td>'.$soldier['soldierName'].'</td>
                <th>الاسم</th>
            </tr>
            <tr>
                <td>'.$payment['ta2reshaAmount'].' ج</td>
                <th>التقريشة</th>
            </tr>
        </tbody>';
        
    }
    
}

if(isset($_GET['code'])){
    retreiveTa2reshaData($_GET['code']);
}
?>
