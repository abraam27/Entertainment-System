<?php
    require_once '../../AdminSession.php';
    require_once '../../model/category.php';
    require_once '../../template/head.tpl';
?>	
        <div class="right-container">
            <p class="header"> <a href="categories.php"> Categories </a> / Add Category </P>
        </div>
    </div>
</div>
<div id="content">
    <div class="container">
        <?php
            require_once '../../template/navbar2.tpl';
        ?>
        <div class="right-container">
            
            <div class="well">
                <?php
                    if(isset($_POST['add'])){
                        $categoryName = $_POST['categoryName'];
                        $categoryType = $_POST['categoryType'];

                        $category = new Category($categoryName, $categoryType);

                        if($category->add()){
                            echo '<div class="greenMessage">
                                    <p>التصنيف اتضاف</p>
                                </div>';
                        }else{
                            echo '<div class="redMessage">
                                    <p>التصنيف متضافش معلش !</p>
                                </div>';
                        }
                    }
                ?>
                <div class="form-container">
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" accept-charset="utf-8">
                        <div class="form-group">
                            <label for="exampleInputText">الاسم</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="ادخل الاسم" name="categoryName">
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">النوع ؟</label>
                            <select class="form-control" style="direction:rtl;" name="categoryType">
                                <option disabled selected>اختار النوع ؟</option>
                                <option value="0">الكنتين</option>
                                <option value="1">التصنيع</option>
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