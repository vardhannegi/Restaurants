<?php include('partials-front/menu.php');?>
    <!-- Food Search Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL;?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>


    <!-- Food Menu Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php
            $sql = "SELECT * FROM tbl_food WHERE active = 'yes' AND featured='yes' LIMIT 6";
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
                </div>
                    ';


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