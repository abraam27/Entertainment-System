<?php
    require_once '../../UserSession.php';
    require_once '../../lib/soldier.php';
    require_once '../../lib/order.php';
    require_once '../../model/payment.php';
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
                    $orderCode = 0;
                    for($i = 0; $i < 9; $i++) { $orderCode .= mt_rand(0, 9); }
                    if(isset($_POST['add'])){
                        $noOfItems = $_POST['noOfItems'];
                        $totalPrice = $_POST['totalPrice'];
                        $orderType = $_POST['orderType'];
                        $code = $_POST['code'];
                        if(is_numeric($code)){
                            $order = new Order($orderCode, date("d-m-yy"), date("h:i:s a"), $noOfItems, $totalPrice, $orderType,$code);
                            if($order->addOrderBySoldierCode()){
                                header("location: orders.php?addOrderSuccess=1&flag="+$orderType);
                                exit();
                            } else {
                                header("location: orders.php?addOrderSuccess=0&flag="+$orderType);
                                exit();
                            }
                        }else{
                            $order = new Order($orderCode, date("d-m-yy"), date("h:i:s a"), $noOfItems, $totalPrice, $orderType);
                            if($order->addOrder()){
                                header("location: orders.php?addOrderSuccess=1&flag=".$orderType);
                                exit();
                            } else {
                                header("location: orders.php?addOrderSuccess=0&flag=".$orderType);
                                exit();
                            }
                        }
                    }
                ?>
                <div class="form-container">
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" accept-charset="utf-8">
                        <div class="form-group">
                            <label for="exampleInputText">السعر </label>
                            <input type="text" class="form-control" id="exampleInputText" aria-describedby="textHelp" placeholder="..,.. ج" name="totalPrice"> 
                        </div>
                        <div class="form-group">
                            <label for="exampleSelect1">العدد ؟</label>
                            <select class="form-control" style="direction:rtl;" name="noOfItems">
                                <option disabled selected>اختار العدد ؟</option>
                                <?php
                                    for($i = 1; $i < 11; $i++) 
                                    { 
                                        echo '<option value="'.$i.'">'.$i.'</option>';
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputText" style="width: 100%;direction: rtl;">كود العسكري للتقريشة</label>
                            <input type="text" class="form-control" id="exampleInput" aria-describedby="textHelp" placeholder="Soldier Code" name="code" style="margin:auto auto; text-align:center;">
                        </div>
                        <input type="hidden" name="orderType" value="<?php echo $orderType; ?>">
                        <table class="table table-striped mt32 customers-list" id="info">
                        
                            <?php require_once 'ta2reshaData.php'; ?>
                                    
                        </table>
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