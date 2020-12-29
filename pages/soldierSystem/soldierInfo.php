<?php
    require_once '../../AdminSession.php';
    require_once '../../lib/soldier.php';
    require_once '../../template/head.tpl';
?>	
                <?php
                    if(isset($_GET['soldierID'])){
                        $soldier = Soldier::retreiveSoldierByID($_GET['soldierID']);
                ?>
        <div class="right-container">
            <p class="header"> <a href="allSoldiers.php"> Soldiers </a> / <a href="addSoldier.php"> Add Soldier </a> / <a href="editSoldier.php?soldierID=<?php echo $soldier['soldierID'];?>"> Edit Soldier </a> / <a href="?action=delete&soldierID=<?php echo $soldier['soldierID'];?>"> Delete Soldier </a></P>
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
                        if(isset($_GET['action']) && is_numeric($_SESSION["Admin"])){
                            if($_GET['action'] == 'delete'){
                                echo'<div class="form-container">
                                        <form action="?soldierID='.$soldier['soldierID'].'" method="POST" accept-charset="utf-8">
                                            <div class="form-group">
                                                <label for="exampleInputText" class="pull-right" style="font-size:20px">متاكد انك عايز تمسحه ؟</label>
                                            </div>
                                            <button type="submit">لا</button>
                                            <button type="submit" formaction="allSoldiers.php" formmethod="get" name="soldierID" value="'.$soldier['soldierID'].'">اه</button>
                                        </form>
                                </div>';
                            }
                        }
                        if(isset($_GET['action'])){
                            if($_GET['action'] == 'editYes'){
                                echo '<div class="greenMessage">
                                    <p>العسكري اتعدل</p>
                                </div>';
                            }elseif($_GET['action'] == 'editNo'){
                                echo '<div class="redMessage">
                                    <p>العسكري متعدلش معلش !</p>
                                </div>';
                            }
                        }
                        echo '<h3>
                                <span class="pull-right">'.$soldier['soldierName'].'</span>
                            </h3>
                            <br/>
                            <table class="table table-striped mt32 customers-list">
                                <tbody>
                                    <tr>
                                        <td>'.$soldier['SSN'].'</td>
                                        <th width="300px">الرقم القومي</th>
                                    </tr>
                                    <tr>
                                        <td>'.$soldier['militaryNo'].'</td>
                                        <th>الرقم العسكري</th>
                                    </tr>
                                    <tr>
                                        <td>'.$soldier['address'].'</td>
                                        <th>العنوان</th>
                                    </tr>
                                    <tr>
                                        <td>'.$soldier['district'].'</td>
                                        <th>المنطقة</th>
                                    </tr>
                                    <tr>
                                        <td>'.$soldier['city'].'</td>
                                        <th>المحافظة</th>
                                    </tr>
                                    <tr>
                                        <td>'.$soldier['phoneNo1'].'</td>
                                        <th>رقم الموبيل الأول</th>
                                    </tr>
                                    <tr>
                                        <td>'.$soldier['phoneNo2'].'</td>
                                        <th>رقم الموبيل القاني</th>
                                    </tr>
                                    <tr>
                                        <td>'.$soldier['bloodGroup'].'</td>
                                        <th>فصيلو الدم</th>
                                    </tr>
                                    <tr>
                                        <td>'.$soldier['religion'].'</td>
                                        <th>الديانة</th>
                                    </tr>
                                    <tr>
                                        <td>'.$soldier['degree'].'</td>
                                        <th>الدرجة</th>
                                    </tr>
                                    <tr>
                                        <td>'.$soldier['dateOfBirth'].'</td>
                                        <th>تاريخ الميلاد</th>
                                    </tr>
                                    <tr>
                                        <td>'.$soldier['dateOfRecruitment'].'</td>
                                        <th>تاريخ التجنيد</th>
                                    </tr>
                                    <tr>
                                        <td>'.$soldier['dateOfLayoffs'].'</td>
                                        <th>تاريخ التسريح</th>
                                    </tr>
                                    <tr>
                                        <td>'.$soldier['code'].'</td>
                                        <th>كود التقريشة</th>
                                    </tr>
                                    <tr>
                                        <td>'.$soldier['tmam'].'</td>
                                        <th>التمام</th>
                                    </tr>
                                    <tr>';
                                        if($soldier['battalionNo'] == 1){
                                            echo '<td>الكتيبة الأولي</td>';
                                        }elseif($soldier['battalionNo'] == 2){
                                            echo '<td>الكتيبة الثانية</td>';
                                        }elseif($soldier['battalionNo'] == 2){
                                            echo '<td>الكتيبة الثالثة</td>';
                                        }else{
                                            echo '<td>قيادة الفوج</td>';
                                        }
                                        
                                        echo '<th>الكتيبة</th>
                                    </tr>
                                </tbody>
                            </table>';
                    }
                    
                ?>
            </div>
        </div>
    </div>
</div>
<?php
    require_once '../../template/footer.tpl';
?>