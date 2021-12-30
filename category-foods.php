<?php include('partials-front/menu.php');

if(isset($_GET['category_id'])){
    $category_id = $_GET['category_id'];
    $sql = "SELECT title FROM tbl_category WHERE id=$category_id";
    $res = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($res);
    $category_title = $row['title'];
            
}

?>
    <!-- Food Search Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white">"<?php echo $category_title;?>"</a></h2>

        </div>
    </section>
 

    <!-- Food Menu Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            $sql = "SELECT * FROM tbl_food WHERE category_id=$category_id";
            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];

                    echo '
                    <div class="food-menu-box">
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
                                <h4>'.$title.'</h4>
                                <p class="food-price">'.$price.'</p>
                                <p class="food-detail">
                                    '.$description.'
                                </p>
                                <br>
            
                                <a href="'.SITEURL.'order.php?food_id='.$id.'" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>';


                }

            }else{
                echo'<div class="error">Category not Added</div>';
            }
            
            ?>
            <div class="clearfix"></div>

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