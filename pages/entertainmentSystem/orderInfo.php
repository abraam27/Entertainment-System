<?php
    require_once '../../UserSession.php';
    require_once '../../lib/order.php';
    require_once '../../model/orderdetails.php';
    require_once '../../model/category.php';
    require_once '../../model/product.php';
    require_once '../../template/head.tpl';
?>	
        <?php
            if(isset($_GET['orderID'])){
                $order = Order::retreiveOrderByID($_GET['orderID']);
        ?>
        <div class="right-container">
            <p class="header"> <a href="orders.php"> Orders </a> / <a href="editOrder?orderID=<?php echo $order['orderID'];?>"> Edit Order </a> / <a href="?action=delete&orderID=<?php echo $order['orderID'];?>"> Delete Order </a></P>
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
                        if($_GET['action'] == 'delete'){
                            echo'<div class="form-container">
                                    <form action="?categoryID='.$category['categoryID'].'" method="POST" accept-charset="utf-8">
                                        <div class="form-group">
                                            <label for="exampleInputText" class="pull-right" style="font-size:20px">متاكد انك عايز تمسحه ؟</label>
                                        </div>
                                        <button type="submit">لا</button>
                                        <button type="submit" formaction="orders.php" formmethod="get" name="orderID" value="'.$order['orderID'].'">اه</button>
                                    </form>
                            </div>';
                        }
                    }
                    if(isset($_GET['productID'])){
                        $productID = $_GET['productID'];
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
                    <span>بيانات المنتجات الموجودة فى الصنف <?php echo $category['categoryName'];?></span>
                    <input type="search" placeholder="بحث..." class="form-control search-input" data-table="customers-list"/>
                </h3>
                <table class="table table-striped mt32 customers-list">
                    <thead>
                        <tr>
                            <th>مسح</th>
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
                            $products = Product::retrieveAllProductsByCategoryID($category['categoryID']);
                            if(is_array($products) && count($products)>0){
                                foreach ($products as $product){
                                    echo '<tr>
                                        <td><a href="?categoryID='.$category['categoryID'].'&productID='.$product['productID'].'"><img class="imagelink" src="../../images/waste.png"/></a></td>
                                        <td><a href="editProduct.php?productID='.$product['productID'].'"><img class="imagelink" src="../../images/edit.png"/></a></td>
                                        <td>'.$product['dateInStock'].'</td>
                                        <td>'.$product['price'].' ج</td>
                                        <td>'.$product['qty'].'</td>
                                        <td>'.$product['productName'].'</td>
                                        <td>'.$product['productCode'].'</td>
                                        <td>'.$count++.'</td>
                                    </tr>';
                                }
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