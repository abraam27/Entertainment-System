<?php
    require_once '../../AdminSession.php';
    require_once '../../lib/soldier.php';
    require_once '../../template/head.tpl';
?>	
        <div class="right-container">
            <p class="header"> <a href="allSoldiers.php"> Soldiers </a> / Edit Soldier </P>
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
                    if(isset($_POST['edit'])){
                        $soldierID = $_POST['soldierID'];
                        $SSN = $_POST['SSN'];
                        $militaryNo = $_POST['militaryNo'];
                        $soldierName = $_POST['soldierName'];
                        $address = $_POST['address'];
                        $district = $_POST['district'];
                        $city = $_POST['city'];
                        $phoneNo1 = $_POST['phoneNo1'];
                        $phoneNo2 = $_POST['phoneNo2'];
                        $maritalStatus = $_POST['maritalStatus'];
                        $bloodGroup = $_POST['bloodGroup'];
                        $religion = $_POST['religion'];
                        $degree = $_POST['degree'];
                        $battalionNo = $_POST['battalionNo'];
                        $dateOfBirth = $_POST['dateOfBirth'];
                        $dateOfRecruitment = $_POST['dateOfRecruitment'];
                        $dateOfLayoffs = $_POST['dateOfLayoffs'];
                        $code = $_POST['code'];
                        $tmam = $_POST['tmam'];

                        $soldier = new Soldier($SSN, $militaryNo, $soldierName, $address, $district, $city, $phoneNo1, $phoneNo2, $maritalStatus, $bloodGroup, $religion, $degree, $battalionNo, $dateOfBirth, $dateOfRecruitment, $dateOfLayoffs, $code, $tmam, $soldierID);

                        if($soldier->editSoldier()){
                            header("location: soldierInfo.php?action=editYes&soldierID=".$soldierID);
                            
                        }else{
                            header("location: soldierInfo.php?action=editNo&soldierID=".$soldierID);
                            
                        }
                    }
                ?>
                
                <div class="form-container">
                    <?php
                        if(isset($_GET['soldierID'])){
                            $soldier = Soldier::retreiveSoldierByID($_GET['soldierID']);
                            echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST" accept-charset="utf-8">
                                    <div class="form-group">
                                        <label for="exampleInputText">الرقم القومي</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="ادخل الرقم القومي المكون من 16 رقم" name="SSN" value="'.$soldier['SSN'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">الرقم العسكري</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="ادخل الرقم العسكرس" name="militaryNo" value="'.$soldier['militaryNo'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">الاسم رباعي ؟</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="الاسم رباعي ؟" name="soldierName" value="'.$soldier['soldierName'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">العنوان</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="العنوان بالتفصيل ؟" name="address" value="'.$soldier['address'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">المنطقة / المركز</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="المنطقة / المركز" name="district" value="'.$soldier['district'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">المحافظة</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="المحافظة" name="city" value="'.$soldier['city'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">رقم الموبيل الأول</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="رقم الموبيل الأول ؟" name="phoneNo1" value="'.$soldier['phoneNo1'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">رقم الموبيل الثاني</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="رقم الموبيل الثاني ؟" name="phoneNo2" value="'.$soldier['phoneNo2'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">الحالة الأجتماعية</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="الحالة الأجتماعية" name="maritalStatus" value="'.$soldier['maritalStatus'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">فصيلة الدم ؟</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="فصيلة الدم" name="bloodGroup" value="'.$soldier['bloodGroup'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelect1">الديانة</label>
                                        <select class="form-control" style="direction:rtl;" name="religion">
                                            <option disabled selected>اختار الديانة ؟</option>
                                            <option value="مسيحي">مسيحي</option>
                                            <option value="مسلم">مسلم</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">الدرجة</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="الدرجة" name="degree" value="'.$soldier['degree'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">كود التقريشة</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="كود التقريشة ؟" name="code" value="'.$soldier['code'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">التمام</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="تمامه" name="tmam" value="'.$soldier['tmam'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText" style="width: 100%;direction: rtl;">اختار التاريخ الميلاد ؟</label>
                                        <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                            <input type="text"  class="form-control" id="exampleInputText"  readonly aria-describedby="textHelp" style="direction:rtl;" name="dateOfBirth" value="'.$soldier['dateOfBirth'].'">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText" style="width: 100%;direction: rtl;">اختار التاريخ التجنيد ؟</label>
                                        <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                            <input type="text"  class="form-control" id="exampleInputText"  readonly aria-describedby="textHelp" style="direction:rtl;" name="dateOfRecruitment" value="'.$soldier['dateOfRecruitment'].'">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText" style="width: 100%;direction: rtl;">اختار التاريخ التسريح ؟</label>
                                        <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                            <input type="text"  class="form-control" id="exampleInputText"  readonly aria-describedby="textHelp" style="direction:rtl;" name="dateOfLayoffs" value="'.$soldier['dateOfLayoffs'].'">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelect1">الكتيبة ؟</label>
                                        <select class="form-control" style="direction:rtl;" name="battalionNo">
                                            <option disabled selected>اختار الكتيبة ؟</option>
                                            <option value="1">الكتيبة الأولي</option>
                                            <option value="2">الكتيبة الثانية</option>
                                            <option value="3">الكتيبة الثالثة</option>
                                            <option value="4">قيادة الفوج</option>
                                        </select>
                                    </div>
                                    <input type="hidden" name="soldierID" value="'.$soldier['soldierID'].'">
                                    <button type="submit" class="btn btn-secondary btn-lg btn-block" name="edit" value="edit">EDIT</button>
                                </form>';
                        }
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    require_once '../../template/footer.tpl';
?>