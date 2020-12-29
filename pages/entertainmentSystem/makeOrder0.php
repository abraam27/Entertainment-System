<?php
    require_once '../../model/category.php';
    require_once '../../model/product.php';
    require_once '../../model/cart.php';
    require_once '../../template/head.tpl';
    $orderType = 0;
    if(isset($_GET['flag'])){
        $orderType = $_GET['flag'];
    }
?>
			
        <div class="right-container">
            <p class="header"> <a href="orders.php?flag=<?php echo $orderType;?>"> Orders </a> /  Make Order </P>
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
                            Cart::delete($_GET['id']);
                        }
                    }
                    $flag = 0;
                    $code = '';
                    $count = 1;
                    for($i = 0; $i < 10; $i++) { $code .= mt_rand(0, 9); }
                    if(isset($_GET['productID'])){
                        $carts = Cart::readAll();
                        $qty = 1;
                        $productID = $_GET['productID'];
                        if(count($carts) == 0){
                            $cart = new Cart($productID, $qty);
                            $cart->add();
                        }else{
                            foreach ($carts as $cart){
                                if($cart['productID'] == $productID ){
                                    Cart::updateQtyInCart($cart['cartID'], $cart['qty']+1);
                                    $flag = 1;
                                }
                            }
                            if($flag == 0){
                                $cart = new Cart($productID, $qty);
                                $cart->add();
                            }
                        }
                    }
                ?>
                <?php
                    $carts = Cart::readAll();
                    if(is_array($carts) && count($carts)>0){
                        echo '<table class="table table-striped mt32 customers-list">
                                <thead>
                                    <tr>
                                        <th>مسح</th>
                                        <th>العدد</th>
                                        <th>السعر</th>
                                        <th width="200px">الاسم</th>
                                        <th>الكود</th>
                                        <th>م</th>
                                    </tr>
                                </thead>';
                        foreach ($carts as $cart){
                            $product = Product::readById($cart['productID']);
                            echo '<tbody>
                                <tr>
                                    <td><a href="?action=delete&id='.$cart['cartID'].'"><img class="imagelink" src="../../images/waste.png"/></a></td>
                                    <td>'.$cart['qty'].'</td>
                                    <td>'.$product['price'].' ج</td>
                                    <td>'.$product['productName'].'</td>
                                    <td>'.$product['productCode'].'</td>
                                    <td>'.$count++.'</td>
                                </tr>
                                </tbody>';
                        }
                        echo '
                            </table>
                            <form>
                                <button type="submit" class="btn btn-secondary btn-lg btn-block" formaction="confirmOrder.php" >Finish</button>
                            </form>';
                            
                    }
                ?>
                <?php
                    $categories = Category::retrieveAllCategoriesByCategoryType($orderType);
                    if(is_array($categories) && count($categories)>0){
                        foreach ($categories as $category) {
                            echo '<div class="titleContext">
                                    <h1>'.$category['categoryName'].'</h1>
                                </div>';
                            echo '<div class="bodyContext">';
                            $products = Product::retrieveAllProductsByCategoryID($category['categoryID']);
                            if(is_array($products) && count($products)>0){
                                $count1 = 1;
                                foreach ($products as $product) {
                                    if($count1%10 == 0){
                                        echo '<a href="?productID='.$product['productID'].'">
                                            <div class="box boxColor pullRight grab">
                                                <div class="bodyBox">
                                                    <p>'.$product['productName'].'</p>
                                                </div>
                                                <div class="footBox">
                                                    '.$product['price'].' ج
                                                </div>
                                            </div>
                                        </a>';
                                    }else{
                                        echo '<a href="?productID='.$product['productID'].'&flag='.$_GET['flag'].'">
                                            <div class="box boxColor grab">
                                                <div class="bodyBox">
                                                    <p>'.$product['productName'].'</p>
                                                </div>
                                                <div class="footBox">
                                                    '.$product['price'].' ج
                                                </div>
                                            </div>
                                        </a>';
                                    }
                                $count1++;
                                }
                            }
                            echo '</div>';
                        }
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