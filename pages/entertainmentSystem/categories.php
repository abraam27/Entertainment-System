<?php
    require_once '../../AdminSession.php';
    require_once '../../model/category.php';
    require_once '../../template/head.tpl';
?>	
        <div class="right-container">
            <p class="header"> Categories / <a href="addCategory.php"> Add Category </a> / <a href="products.php"> Products </a></P>
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
                    
                    if(isset($_GET['categoryID'])){
                        $categoryID = $_GET['categoryID'];
                        if(Category::deleteAllProductByCategoryID($categoryID)){
                            if(Category::delete($categoryID)){
                                echo '<div class="greenMessage">
                                        <p>التصنيف اتمسح !</p>
                                    </div>';
                            }else{
                                echo '<div class="redMessage">
                                        <p>التصنيف متمسحش !</p>
                                    </div>';
                            }
                        }
                    }
                ?>
                <h3>
                    <span>بيانات تصنيفات المنتجات</span>
                    <input type="search" placeholder="بحث..." class="form-control search-input" data-table="customers-list"/>
                </h3>
                <table class="table table-striped mt32 customers-list">
                    <thead>
                        <tr>
                            <th>مسح</th>
                            <th>تعديل</th>
                            <th>نوعه</th>
                            <th>التصنيف</th>
                            <th>م</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $count = 1;
                            $categories = Category::readAll();
                            if(is_array($categories) && count($categories)>0){
                                foreach ($categories as $category){
                                    echo '<tr>
                                        <td><a href="categoryInfo.php?action=delete&categoryID='.$category['categoryID'].'"><img class="imagelink" src="../../images/waste.png"/></a></td>
                                        <td><a href="editCategory.php?categoryID='.$category['categoryID'].'"><img class="imagelink" src="../../images/edit.png"/></a></td>';
                                        if($category['categoryType'] == 0){
                                            echo '<td>الكنتين</td>';
                                        }else{
                                            echo '<td>التصنيع</td>';
                                        }
                                        echo '<td><a class="link" href="categoryInfo.php?categoryID='.$category['categoryID'].'">'.$category['categoryName'].'</a></td>
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