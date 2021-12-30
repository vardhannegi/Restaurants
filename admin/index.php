<?php include('partials/menu.php')?>

 
    <div class="main-content">
        <div class="wrapper">
            <h1>DASHBOARD</h1>
            <div class="col-4 text-center">
            
            <?php
            $sql = "SELECT * FROM tbl_category";
            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);
            ?>
                <h1><?php echo $count;?></h1>
                <br>
                Categories
            </div>

            <div class="col-4 text-center">

            
            <?php
            $sql = "SELECT * FROM tbl_food";
            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);
            ?>

                <h1><?php echo $count;?></h1>
                <br>
                Foods
            </div>

            <div class="col-4 text-center">
                
            <?php
            $sql = "SELECT * FROM tbl_order";
            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);
            ?>
                <h1><?php echo $count;?></h1>
                <br>
                Total Orders
            </div>

            <div class="col-4 text-center">
                
            <?php
            $sql = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivery'";
            $res = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($res);
            $total_revenue = $row['Total'];
            ?>

                <h1><?php echo '$' .$total_revenue;?></h1>
                <br>
                Revenu
            </div>

            <div class="clearfix"></div>

        </div>
    </div>

    <?php include('partials/footer.php')?>