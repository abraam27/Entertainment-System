<?php
    require_once '../../AdminSession.php';
    require_once '../../model/category.php';
    require_once '../../model/product.php';
    require_once '../../template/head.tpl';
?>	
        <div class="right-container">
            <p class="header"> <a href="products.php"> Products </a> / Edit Product </P>
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
                        $productID = $_POST['productID'];
                        $productCode = $_POST['productCode'];
                        $productName = $_POST['productName'];
                        $qty = $_POST['qty'];
                        $price = $_POST['price'];
                        $dateInStock = $_POST['dateInStock'];
                        $categoryID = $_POST['categoryID'];
                        
                        $product = new Product($productCode, $productName, $qty, $price, $dateInStock, $categoryID);
                        if($product->update($productID)){
                            header("location: products.php?action=editYes");
                        }else{
                            header("location: products.php?action=editNo");
                            
                        }
                    }
                ?>
                <div class="form-container">
                    <?php
                        if(isset($_GET['productID'])){
                            $product = Product::readById($_GET['productID']);
                            echo '<form action="'.$_SERVER['PHP_SELF'].'" method="POST" accept-charset="utf-8">
                                    <div class="form-group">
                                        <label for="exampleInputText">كود المنتج</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="كود المنتج ؟" name="productCode" value="'.$product['productCode'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">اسم المنتج</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="ادخل اسم المنتج" name="productName" value="'.$product['productName'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">الكمية ؟</label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="الكمية" name="qty" value="'.$product['qty'].'">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText">السعر </label>
                                        <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="..,.. ج" name="price" value="'.$product['price'].'"> 
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputText" style="width: 100%;direction: rtl;">تاريخ الادخال للمخزن ؟</label>
                                        <div class="input-group date form_date" data-date="" data-date-format="dd-mm-yyyy" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                            <input type="text"  class="form-control" id="exampleInputText"  readonly aria-describedby="textHelp" style="direction:rtl;" name="dateInStock" value="'.$product['dateInStock'].'">
                                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleSelect1">التصنيف ؟</label>
                                        <select class="form-control" style="direction:rtl;" name="categoryID">';
                                        $category = Category::readById($product['categoryID']);
                                            echo'<option value="'.$category['categoryID'].'" selected>'.$category['categoryName'].'</option>';
                                            $categories = Category::readAll();
                                                if(is_array($categories) && count($categories)>0){
                                                    foreach($categories as $category) {
                                                        echo '<option value="'.$category['categoryID'].'">'.$category['categoryName'].'</option>';
                                                    }
                                                }
                                        echo '</select>
                                    </div>
                                    <input type="hidden" name="productID" value="'.$product['productID'].'">
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