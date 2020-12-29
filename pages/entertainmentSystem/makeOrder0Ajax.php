<?php
    require_once '../../UserSession.php';
    require_once '../../model/category.php';
    require_once '../../model/product.php';
    require_once '../../model/cart.php';
    require_once '../../template/head.tpl';
    $orderType = 0;
    if(isset($_GET['flag'])){
        $orderType = $_GET['flag'];
    }
    Cart::emptyCart();
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
                ?>
                <div  id="info">
                <?php
                    require_once 'makeOrderData.php';
                    
                ?>
                </div>
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
                                        echo '<div class="box boxColor pullRight productDiv grab" value="'.$product['productID'].'">
                                                <div class="bodyBox">
                                                    <p>'.$product['productName'].'</p>
                                                </div>
                                                <div class="footBox">
                                                    '.$product['price'].' ج
                                                </div>
                                            </div>';
                                    }else{
                                        echo '<div class="box boxColor productDiv grab" value="'.$product['productID'].'">
                                                <div class="bodyBox">
                                                    <p>'.$product['productName'].'</p>
                                                </div>
                                                <div class="footBox">
                                                    '.$product['price'].' ج
                                                </div>
                                            </div>';
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