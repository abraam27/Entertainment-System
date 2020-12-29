<?php
    require_once '../../AdminSession.php';
    require_once '../../model/category.php';
    require_once '../../model/product.php';
    require_once '../../template/head.tpl';
?>	
        <?php
            if(isset($_GET['productID'])){
                $product = Product::readById($_GET['productID']);
            }
        ?>
        <div class="right-container">
            <p class="header"> Products / <a href="addProduct.php"> Add Product </a> / <a href="categories.php"> Categories </a></P>
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
                    if(isset($_GET['action'])){
                        if($_GET['action'] == 'editYes'){
                            echo '<div class="greenMessage">
                                <p>المنتح اتعدل</p>
                            </div>';
                        }elseif($_GET['action'] == 'editNo'){
                            echo '<div class="redMessage">
                                <p>المنتح متعدلش معلش !</p>
                            </div>';
                        }
                    }
                    if(isset($_GET['action'])){
                        if($_GET['action'] == 'confirm'){
                            echo'<div class="form-container">
                                    <form action="?productID='.$product['productID'].'" method="POST" accept-charset="utf-8">
                                        <div class="form-group">
                                            <label for="exampleInputText" class="pull-right" style="font-size:20px">متاكد انك عايز تمسحه ؟</label>
                                        </div>
                                        <button type="submit">لا</button>
                                        <button type="submit" formaction="products.php" formmethod="get" name="DelProductID" value="'.$product['productID'].'">اه</button>
                                    </form>
                            </div>';
                        }
                    }
                    if(isset($_GET['DelProductID'])){
                        $productID = $_GET['DelProductID'];
                        if(Product::delete($productID)){
                            echo '<div class="greenMessage">
                                    <p>المنتج اتمسح !</p>
                                </div>';
                        }else{
                            echo '<div class="redMessage">
                                    <p>المنتج متمسحش !</p>
                                </div>';
                        }
                    }
                ?>
                <h3>
                    <span>بيانات المنتجات</span>
                    <input type="search" placeholder="بحث..." class="form-control search-input" data-table="customers-list"/>
                </h3>
                <table class="table table-striped mt32 customers-list">
                    <thead>
                        <tr>
                            <th>مسح</th>
                            <th>تعديل</th>
                            <th>التصنيف</th>
                            <th>تاريخ التخزين</th>
                            <th>السعر</th>
                            <th>الكمية</th>
                            <th>اسم المنتج</th>
                            <th>كود المنتج</th>
                            <th>م</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                            $products = Product::readAll();
                            if(is_array($products) && count($products)>0){
                                foreach ($products as $product){
                                    echo '<tr>
                                        <td><a href="?action=confirm&productID='.$product['productID'].'"><img class="imagelink" src="../../images/waste.png"/></a></td>
                                        <td><a href="editProduct.php?productID='.$product['productID'].'"><img class="imagelink" src="../../images/edit.png"/></a></td>';
                                        $categories = Category::readAll();
                                        if(is_array($categories) && count($categories)>0){
                                            foreach($categories as $category){
                                                if($category['categoryID'] == $product['categoryID']){
                                                    echo '<td>'.$category['categoryName'].'</td>';
                                                }
                                            }
                                        }
                                        echo '<td>'.$product['dateInStock'].'</td>
                                        <td>'.$product['price'].' ج</td>
                                        <td>'.$product['qty'].'</td>
                                        <td>'.$product['productName'].'</td>
                                        <td>'.$product['productCode'].'</td>
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