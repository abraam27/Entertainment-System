<?php
    require_once '../../AdminSession.php';
    require_once '../../lib/soldier.php';
    require_once '../../model/payment.php';
    require_once '../../template/head.tpl';
?>	
        <div class="right-container">
            <p class="header"> Soldiers / <a href="addSoldier.php"> Add Soldier </a></P>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <?php
            require_once '../../template/navbar1.tpl';
        ?>
        <div class="right-container">
            <div class="well">
                <?php
                    
                    if(isset($_GET['soldierID'])){
                        $soldierID = $_GET['soldierID'];
                        if(Payment::deletePaymentBySoldierID($soldierID)){
                            if(Soldier::deleteSoldierById($soldierID)){
                                echo '<div class="greenMessage">
                                        <p>العسكري اتمسح !</p>
                                    </div>';
                            }else{
                                echo '<div class="redMessage">
                                        <p>العسكري متمسحش !</p>
                                    </div>';
                            }
                        }
                    }
                ?>
                <h3>
                    <span>بيانات العساكر و تمامهم</span>
                    <input type="search" placeholder="بحث..." class="form-control search-input" data-table="customers-list"/>
                </h3>
                <table class="table table-striped mt32 customers-list">
                    <thead>
                        <tr>
                            <th>مسح</th>
                            <th>تعديل</th>
                            <th>التمام</th>
                            <th>الكتيبة</th>
                            <th>الاسم</th>
                            <th>الرقم العسكري</th>
                            <th>م</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                            $soldiers = Soldier::retreiveAllSoldiers();
                            if(is_array($soldiers) && count($soldiers)>0){
                                foreach ($soldiers as $soldier){
                                    echo '<tr>
                                        <td><a href="soldierInfo.php?action=delete&soldierID='.$soldier['soldierID'].'"><img class="imagelink" src="../../images/waste.png"/></a></td>
                                        <td><a href="editSoldier.php?soldierID='.$soldier['soldierID'].'"><img class="imagelink" src="../../images/edit.png"/></a></td>
                                        <td>'.$soldier['tmam'].'</td>';
                                        if($soldier['battalionNo'] == 1){
                                            echo '<td>الاولي</td>';
                                        }elseif($soldier['battalionNo'] == 2){
                                            echo '<td>الثانية</td>';
                                        }elseif($soldier['battalionNo'] == 3){
                                            echo '<td>الثالثة</td>';
                                        }else{
                                            echo '<td>قيادة الفوج</td>';
                                        }
                                        echo '<td><a class="link" href="soldierInfo.php?soldierID='.$soldier['soldierID'].'">'.$soldier['soldierName'].'</a></td>
                                        <td>'.$soldier['militaryNo'].'</td>
                                        <td>'.$count++.'</td>
                                    </tr>';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php
    require_once '../../template/footer.tpl';
?>