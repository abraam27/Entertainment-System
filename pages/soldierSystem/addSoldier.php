<?php
    require_once '../../AdminSession.php';
    require_once '../../lib/soldier.php';
    require_once '../../template/head.tpl';
?>	
        <div class="right-container">
            <p class="header"> <a href="allSoldiers.php"> Soldiers </a> / Add Soldier </P>
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
                    if(isset($_POST['add'])){
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

                        $soldier = new Soldier($SSN, $militaryNo, $soldierName, $address, $district, $city, $phoneNo1, $phoneNo2, $maritalStatus, $bloodGroup, $religion, $degree, $battalionNo, $dateOfBirth, $dateOfRecruitment, $dateOfLayoffs, $code, $tmam);

                        if($soldier->addSoldier()){
                            echo '<div class="greenMessage">
                                    <p>العسكرس اتضاف</p>
                                </div>';
                        }else{
                            echo '<div class="redMessage">
                                    <p>العسكرس متضافش معلش !</p>
                                </div>';
                        }
                    }
                ?>
                <div class="form-container">
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" accept-charset="utf-8">
                        <div class="form-group">
                            <label for="exampleInputText">الرقم القومي</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="ادخل الرقم القومي المكون من 16 رقم" name="SSN">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">الرقم العسكري</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="ادخل الرقم العسكرس" name="militaryNo">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">الاسم رباعي ؟</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="الاسم رباعي ؟" name="soldierName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">العنوان</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="العنوان بالتفصيل ؟" name="address">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">المنطقة / المركز</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="المنطقة / المركز" name="district">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">المحافظة</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="المحافظة" name="city">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">رقم الموبيل الأول</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="رقم الموبيل الأول ؟" name="phoneNo1">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">رقم الموبيل الثاني</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="رقم الموبيل الثاني ؟" name="phoneNo2">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">الحالة الأجتماعية</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="الحالة الأجتماعية" name="maritalStatus">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">فصيلة الدم ؟</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="فصيلة الدم" name="bloodGroup">
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">الديانة</label>
                            <select class="form-control" style="direction:rtl;" name="religion">
                                <option disabled selected>اختار الديانة ؟</option>
                                <option value="1">مسيحي</option>
                                <option value="2">مسلم</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">الدرجة</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="الدرجة" name="degree">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">كود التقريشة</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="كود التقريشة ؟" name="code">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">التمام</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="تمامه" name="tmam">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText" style="width: 100%;direction: rtl;">اختار التاريخ الميلاد ؟</label>
                            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                <input type="text"  class="form-control" id="exampleInputText"  readonly aria-describedby="textHelp" style="direction:rtl;" name="dateOfBirth" >
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText" style="width: 100%;direction: rtl;">اختار التاريخ التجنيد ؟</label>
                            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                <input type="text"  class="form-control" id="exampleInputText"  readonly aria-describedby="textHelp" style="direction:rtl;" name="dateOfRecruitment" >
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText" style="width: 100%;direction: rtl;">اختار التاريخ التسريح ؟</label>
                            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                <input type="text"  class="form-control" id="exampleInputText"  readonly aria-describedby="textHelp" style="direction:rtl;" name="dateOfLayoffs" >
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
                        <button type="submit" class="btn btn-secondary btn-lg btn-block" name="add" value="add">ADD</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
    require_once '../../template/footer.tpl';
?>