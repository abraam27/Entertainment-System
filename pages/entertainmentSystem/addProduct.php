<?php
    require_once '../../AdminSession.php';
    require_once '../../model/product.php';
    require_once '../../model/category.php';
    require_once '../../template/head.tpl';
?>	
        <div class="right-container">
            <p class="header"> <a href="products.php"> Products </a> / Add Product </P>
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
                        $productCode = $_POST['productCode'];
                        $productName = $_POST['productName'];
                        $qty = $_POST['qty'];
                        $price = $_POST['price'];
                        $dateInStock = $_POST['dateInStock'];
                        $categoryID = $_POST['categoryID'];

                        $product = new Product($productCode, $productName, $qty, $price, $dateInStock, $categoryID);

                        if($product->add()){
                            echo '<div class="greenMessage">
                                    <p>المنتج اتضاف</p>
                                </div>';
                        }else{
                            echo '<div class="redMessage">
                                    <p>المنتج متضافش معلش !</p>
                                </div>';
                        }
                    }
                ?>
                <div class="form-container">
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" accept-charset="utf-8">
                        <div class="form-group">
                            <label for="exampleInputText">كود المنتج</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="كود المنتج ؟" name="productCode">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">اسم المنتج</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="ادخل اسم المنتج" name="productName">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">الكمية ؟</label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="الكمية" name="qty">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText">السعر </label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="..,.. ج" name="price"> 
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText" style="width: 100%;direction: rtl;">تاريخ الادخال للمخزن ؟</label>
                            <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                <input type="text"  class="form-control" id="exampleInputText"  readonly aria-describedby="textHelp" style="direction:rtl;" name="dateInStock" value="<?php echo date("d-m-yy");?>">
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">التصنيف ؟</label>
                            <select class="form-control" style="direction:rtl;" name="categoryID">
                                <option disabled selected>اختار التصنيف ؟</option>
                                <?php
                                    $categories = Category::readAll();
                                    if(is_array($categories) && count($categories)>0){
                                        foreach($categories as $category) {
                                            echo '<option value="'.$category['categoryID'].'">'.$category['categoryName'].'</option>';
                                        }
                                    }
                                ?>
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