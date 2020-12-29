<?php
    require_once '../../AdminSession.php';
    require_once '../../model/category.php';
    require_once '../../template/head.tpl';
?>	
        <div class="right-container">
            <p class="header"> <a href="categories.php"> Categories </a> / Edit Category </P>
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
                    if(isset($_POST['edit'])){
                        $categoryID = $_POST['categoryID'];
                        $categoryName = $_POST['categoryName'];
                        $categoryType = $_POST['categoryType'];

                        $category = new Category($categoryName, $categoryType);
                        
                        if($category->update($categoryID)){
                            header("location: categoryInfo.php?action=editYes&categoryID=".$categoryID);
                        }else{
                            header("location: categoryInfo.php?action=editNo&categoryID=".$categoryID);
                            
                        }
                    }
                ?>
                <div class="form-container">
                    <?php
                        if(isset($_GET['categoryID'])){
                            $category = Category::readById($_GET['categoryID']);
                            echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST" accept-charset="utf-8">
                                    <div class="form-group">
                                        <label for="exampleInputText">الاسم</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="ادخل الاسم" name="categoryName" value="'.$category['categoryName'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelect1">النوع ؟</label>
                                        <select class="form-control" style="direction:rtl;" name="categoryType">
                                            <option disabled >اختار النوع ؟</option>';
                                            if($category['categoryType'] == 0){
                                                echo '<option value="0" selected>الكنتين</option>';
                                                echo '<option value="1" >التصنيع</option>';
                                            }else{
                                                echo '<option value="0" >الكنتين</option>';
                                                echo '<option value="1" selected>التصنيع</option>';
                                            }
                                        echo'</select>
                                    </div>
                                    <input type="hidden" name="categoryID" value="'.$category['categoryID'].'">
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