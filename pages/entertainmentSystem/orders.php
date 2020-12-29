<?php
    require_once '../../UserSession.php';
    require_once '../../lib/soldier.php';
    require_once '../../lib/order.php';
    require_once '../../model/payment.php';
    require_once '../../model/orderdetails.php';
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
            <p class="header"> Orders / 
                <?php
                    if($orderType == 0 || $orderType == 1){
                        echo '<a href="makeOrder0Ajax.php?flag='.$orderType.'"> Make Order </a></P>';
                    }else{
                        echo '<a href="makeOrder1.php?flag='.$orderType.'"> Make Order </a></P>';
                    }
                ?>
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
                    if(isset($_GET['addOrderSuccess'])){
                        if($_GET['addOrderSuccess']){
                            echo '<div class="greenMessage">
                                <p>احلي اوردر</p>
                            </div>';
                        }else{
                            echo '<div class="redMessage">
                                <p>الاوردر متضافش معلش</p>
                            </div>';
                        }
                    } 
                    $a = 0;
                    $b = 0;
                    if(isset($_POST['confirm'])){
                        $code = $_POST['code'];
                        $orderCode = $_POST['orderCode'];
                        $totalPrice = $_POST['total'];
                        $orderType = $_POST['categoryType'];
                        $carts = Cart::readAll();
                        $noOfItems = count($carts);
                        $soldier = Soldier::retreiveSoldierByCode($code);
                        $payment = Payment::retreivePaymentBySoldierID($soldier['soldierID']);
                        
                        foreach($carts as $cart){
                            $product = Product::readById($cart['productID']);
                            if($product['qty'] < $cart['qty']){
                                $a = 1;
                            }
                        }
                        if($a){
                            echo '<div class="redMessage">
                                <p>الاوردر متضافش معلش علشان عدد المنتجات</p>
                            </div>';
                        }else{
                            if(is_numeric($code)){
                                if($payment['ta2reshaAmount'] >= $totalPrice){
                                    $order = new Order($orderCode, date("d-m-yy"), date("h:i:s a"), $noOfItems, $totalPrice, $orderType,$soldier['soldierID']);
                                    $orderID = $order->addOrderBySoldierID();
                                    if(is_numeric($orderID)){
                                        Payment::updateTa2reshaAmount($payment['ta2reshaAmount'] - $totalPrice, $soldier['soldierID']);
                                        foreach($carts as $cart){
                                            $product = Product::readById($cart['productID']);
                                            Product::updateProductQty($product['qty']-$cart['qty'], $product['productID']);
                                            $orderDetail = new Orderdetails($cart['productID'], $cart['qty'], $orderID);
                                            $orderDetail->add();
                                        }
                                        $b = 1;
                                    }
                                    if($b){
                                        Cart::emptyCart();
                                        echo '<div class="greenMessage">
                                            <p>احلي اوردر</p>
                                        </div>';
                                    }else{
                                        echo '<div class="redMessage">
                                            <p>الاوردر متضافش معلش</p>
                                        </div>';
                                    }
                                }else{
                                    echo '<div class="redMessage">
                                            <p>الاوردر متضافش معلش علشان معكش تقريشة كفاية</p>
                                        </div>';
                                }
                            }else{
                                $order = new Order($orderCode, date("d-m-yy"), date("h:i:s a"), $noOfItems, $totalPrice, $orderType);
                                $orderID = $order->addOrderBySoldierID();
                                if(is_numeric($orderID)){
                                    foreach($carts as $cart){
                                        $product = Product::readById($cart['productID']);
                                        Product::updateProductQty($product['qty']-$cart['qty'], $product['productID']);
                                        $orderDetail = new Orderdetails($cart['productID'], $cart['qty'], $orderID);
                                        $orderDetail->add();
                                    }
                                    $b = 1;
                                }
                                if($b){
                                    Cart::emptyCart();
                                    echo '<div class="greenMessage">
                                        <p>احلي اوردر</p>
                                    </div>';
                                }else{
                                    echo '<div class="redMessage">
                                        <p>الاوردر متضافش معلش</p>
                                    </div>';
                                }
                            }
                        }
                    }
                    // بمسح الاوردر
                    if(isset($_GET['orderID'])){
                        $orderDetails = Orderdetails::retreiveDetailsByOrderID($_GET['orderID']);
                        if(is_array($orderDetails) && count($orderDetails)>0){
                            foreach($orderDetails as $orderDetail) {
                                $curProduct = Product::readById($orderDetail['productID']);
                                Product::updateProductQty($orderDetail['qty'] + $curProduct['qty'], $curProduct['productID']);
                            }
                        }
                        Orderdetails::deleteOrderDetailsByOrderID($_GET['orderID']);
                        $order = Order::retreiveOrderByID($_GET['orderID']);
                        if(is_numeric($order['soldierID'])){
                            $soldier = Soldier::retreiveSoldierByID($order['soldierID']);
                            $curPayment = Payment::retreivePaymentBySoldierID($soldier['soldierID']);
                            $payment = Payment::updateTa2reshaAmount($order['totalPrice'] + $curPayment['ta2reshaAmount'], $soldier['soldierID']);
                        }
                        if(Order::deleteOrderByID($_GET['orderID'])){
                            echo '<div class="greenMessage">
                                    <p>الاوردر اتمسح !</p>
                                </div>';
                        }else{
                            echo '<div class="redMessage">
                                    <p>الاوردر متمسحش !</p>
                                </div>';
                        }
                    }
                ?>
                <h3>
                    <?php
                        if($orderType == 0){
                            echo '<span>طلبات الكنتين</span>';
                        }elseif($orderType == 1){
                            echo '<span>طلبات التصنيع</span>';
                        }elseif($orderType == 2){
                            echo '<span>طلبات المغسلة</span>';
                        }elseif($orderType == 3){
                            echo '<span>طلبات الحلاق</span>';
                        }elseif($orderType == 4){
                            echo '<span>طلبات الترزي</span>';
                        }else{
                            echo '<span>طلبات البلاستيشن</span>';
                        }
                    ?>
                    
                    <input type="search" placeholder="بحث..." class="form-control search-input" data-table="customers-list"/>
                </h3>
                <table class="table table-striped mt32 customers-list">
                    <thead>
                        <tr>
                            <th>مسح</th>
                            <th>تعديل</th>
                            <th>السعر</th>
                            <th>الوقت</th>
                            <th>التاريخ</th>
                            <th>رقم الطلب</th>
                            <th>م</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                            $orders = Order::retrieveAllOrdersByOrderType($orderType);
                            if(is_array($orders) && count($orders)>0){
                                foreach ($orders as $order){
                                    echo '<tr>
                                        <td><a href="orders.php?orderID='.$order['orderID'].'"><img class="imagelink" src="../../images/waste.png"/></a></td>
                                        <td><a href="editOrder.php?orderID='.$order['orderID'].'"><img class="imagelink" src="../../images/edit.png"/></a></td>                           
                                        <td>'.$order['totalPrice'].'</td>
                                        <td>'.$order['time'].'</td>
                                        <td>'.$order['date'].'</td>';
                                    if($orderType == 0 || $orderType == 1){
                                        echo '<td><a class="link" href="orderInfo.php?orderID='.$order['orderID'].'">'.$order['orderCode'].'</a></td>';
                                    }else{
                                        echo '<td>'.$order['orderCode'].'</td>';
                                    }
                                    echo '<td>'.$count++.'</td>
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