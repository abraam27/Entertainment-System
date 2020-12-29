<?php
    require_once '../../UserSession.php';
    require_once '../../lib/soldier.php';
    require_once '../../lib/order.php';
    require_once '../../model/payment.php';
    require_once '../../model/category.php';
    require_once '../../model/product.php';
    require_once '../../model/cart.php';
    require_once '../../template/head.tpl';
?>
			
        <div class="right-container">
            <p class="header"> <a href="makeOrder0Ajax.php"> Make Order </a> / <a href="orders.php"> Orders </a> / <a href="categories.php"> Categories </a> </P>
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
                    $total = 0;
                    $orderCode = 0;
                    $count = 1;
                    $categoryType = 0;
                    for($i = 0; $i < 9; $i++) { $orderCode .= mt_rand(0, 9); }
                    if(isset($_GET['action'])){
                        if($_GET['action'] == 'delete'){
                            Cart::delete($_GET['id']);
                            if(count(Cart::readAll())==0){
                                header("location: makeOrder0Ajax.php?flag=".$_GET['flag']);
                            }
                        }else{
                            Cart::emptyCart();
                            header("location: makeOrder0Ajax.php?flag=".$_GET['flag']);
                        }
                    }
                ?>
                <h3>
                    <span class="pull-right"><?php echo $orderCode;?> :رقم الطلب </span>
                </h3>
                <?php
                    $carts = Cart::readAll();
                    if(is_array($carts) && count($carts)>0){
                        echo '<table class="table table-striped mt32 customers-list">
                                <thead>
                                    <tr>
                                        <th>مسح</th>
                                        <th>المجموع</th>
                                        <th>العدد</th>
                                        <th>السعر</th>
                                        <th width="200px">الاسم</th>
                                        <th>الكود</th>
                                        <th>م</th>
                                    </tr>
                                </thead>';
                        foreach ($carts as $cart){
                            $product = Product::readById($cart['productID']);
                            $categoryType = Category::retrieveCategoryTypeByCategoryID($product['categoryID']);
                            echo '<tbody>
                                <tr>
                                    <td><a href="?flag='.$categoryType.'&action=delete&id='.$cart['cartID'].'"><img class="imagelink" src="../../images/waste.png"/></a></td>
                                    <td>'.$cart['qty']*$product['price'].' ج</td>
                                    <td>'.$cart['qty'].'</td>
                                    <td>'.$product['price'].' ج</td>
                                    <td>'.$product['productName'].'</td>
                                    <td>'.$product['productCode'].'</td>
                                    <td>'.$count++.'</td>
                                </tr>';
                            $total += $cart['qty']*$product['price'];
                            
                        }
                        echo '<tr>
                                    <td><a href="?flag='.$categoryType.'&action=deleteAll&id='.$cart['cartID'].'"><img class="imagelink" src="../../images/waste.png"/></a></td>
                                    <td>'.$total.' ج</td>
                                    <td colspan="5">Total Order Price</td>
                                </tr>
                            </tbody>
                            </table>
                            <form class="form-container" action="orders.php" method="POST" accept-charset="utf-8">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="exampleInput" aria-describedby="textHelp" placeholder="Soldier Code" name="code" style="margin:auto auto; text-align:center;">
                                    <input type="hidden" name="orderCode" value="'.$orderCode.'">
                                    <input type="hidden" name="total" value="'.$total.'">
                                    <input type="hidden" name="categoryType" value="'.$categoryType.'">
                                </div>
                                <table class="table table-striped mt32 customers-list" id="info">';
                        
                                    require_once 'ta2reshaData.php';
                                    
                                echo'</table>
                                    <button type="submit" class="btn btn-secondary btn-lg btn-block" name="confirm" value="confirm">Confirm</button>
                                    <button type="submit" class="btn btn-secondary btn-lg btn-block" formaction="makeOrder0Ajax.php" >Cancel</button>
                            </form>';
                    }
                ?>
            </div>
        </div>
    </div>
</div>
<?php
    require_once '../../template/footer.tpl';
?>