<?php
require_once '../../config.php';
require_once '../../model/cart.php';
require_once '../../model/product.php';
require_once '../../model/category.php';
function retreiveTableData($productID)
{   
    $flag = 0;
    $count = 1;
    $qty = 1;
    $carts = Cart::readAll();
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
    $carts = Cart::readAll();
    if(is_array($carts) && count($carts)>0){
        echo '<table class="table table-striped mt32 customers-list">
                <thead>
                    <tr>
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
                <button type="submit" class="btn btn-secondary btn-lg btn-block" formaction="?" >Cancel</button>
            </form>';

    }
}

if(isset($_GET['productID'])){
    retreiveTableData($_GET['productID']);
}
?>
