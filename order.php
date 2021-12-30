   
<?php include('partials-front/menu.php');

if(isset($_GET['food_id'])){

    $food_id = $_GET['food_id'];
    $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
    $res = mysqli_query($conn,$sql);
    $count = mysqli_num_rows($res);
    if($count==1){
        $row = mysqli_fetch_assoc($res);
        // $id = $row['id'];
        $title = $row['title'];
        $price = $row['price'];
        // $description = $row['description'];
        $image_name = $row['image_name'];
    }

}else{

}
?>
    <!-- Food Search Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Fill this form to confirm your order.</h2>

            <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <?php
                    echo'

                    <div class="food-menu-img">
                    ';
                        if($image_name=="")
                        {
                            echo '<div class="error">Image Not Available</div>';
                        }else{
                            echo'<img src="'.SITEURL.'images/food/'.$image_name.'" alt="Pizza" class="img-responsive img-curve">';
                        }
                        
                        echo '
                    </div>
    
                    <div class="food-menu-desc">
                        <h3>'.$title.'</h3>
                        <input type="hidden" name="food" value="'.$title.'">
                        <p class="food-price">'.$price.'</p>
                        <input type="hidden" name="price" value="'.$price.'">
                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>';
                    ?>

                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Vardhan Negi" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 9843xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. varnegi@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>

            </form>

            <?php
            if(isset($_POST['submit'])){
                $food            = $_POST['food'];
                $price           = $_POST['price'];
                $qty             = $_POST['qty'];
                $total           = $price*$qty;
                $order_date        = $_POST['Y-m-d h:i:sa'];
                $status           = 'Ordered';
                $customer_name    = $_POST['full-name'];
                $customer_contact  = $_POST['contact'];
                $customer_email     = $_POST['email'];
                $customer_address   = $_POST['address'];

                $sql2 = "INSERT INTO tbl_order SET
                food= '$food',
                price= '$price',
                qty= '$qty',
                total= '$total',
                order_date= '$order_date',
                status= '$status',
                customer_name= '$customer_name',
                customer_contact = '$customer_contact',
                customer_email= '$customer_email',
                customer_address = '$customer_address'";

                $res2 = mysqli_query($conn,$sql2);
                if($res2==true){
                    $_SESSION['order'] = '<div class="success text-center">Food ordered Successfully. </div>';
                    header('location:'.SITEURL);
                }else{
                    $_SESSION['order'] = '<div class="error text-center">Failed to Order Food. </div>';
                    header('location:'.SITEURL);
                }
            }
            ?>

        </div>
    </section>

    <!-- Contacts Starts Here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
                </li>
                <li>
                    <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
                </li>
            </ul>
        </div>
    </section>
   

<?php include('partials-front/footer.php');?>