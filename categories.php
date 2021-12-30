<?php include('partials-front/menu.php');
?>
    <!-- Categories Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php
            $sql = "SELECT * FROM tbl_category WHERE active = 'yes' ";
            $res = mysqli_query($conn,$sql);
            $count = mysqli_num_rows($res);
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];

                    echo '
                        <a href="'.SITEURL.'category-foods.php?category_id='.$id.'">
                        <div class="box-3 float-container">';
                        if($image_name=="")
                        {
                            echo '<div class="error">Image Not Available</div>';
                        }else{
                            echo'<img src="'.SITEURL.'images/category/'.$image_name.'" alt="Pizza" class="img-responsive img-curve">';
                        }
                        
                        echo '<h3 class="float-text text-white">'.$title.'</h3>
                        </div>
                        </a>';


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