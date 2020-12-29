<div class="left-container">
        <div class="vertical-menu">
            <a href="categories.php">الأصناف و المنتجات</a>
            <a href="orders.php?flag=0">الكانتين</a>
            <a href="orders.php?flag=1">التصنيع</a>
            <a href="orders.php?flag=2">المغسلة</a>
            <a href="orders.php?flag=3">الحلاق</a>
            <a href="orders.php?flag=4">الترزي</a>
            <a href="orders.php?flag=5">البلاستيشن</a>
            <?php
                if(is_numeric($_SESSION["Admin"])){
                    echo '<a href="../soldierSystem/allSoldiers.php">نظام العساكر</a>';
                }
            ?>
            <a href="../../logout.php">خروج</a>
        </div>
</div>