<?php include('partials/menu.php')?>

<div class="main-content">
        <div class="wrapper">
            <h1>MANAGE FOOD</h1>

            <br> <br>


            <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['upload'])){
                echo $_SESSION['upload'];
               unset($_SESSION['upload']);
            }

            if(isset($_SESSION['remove'])){
                echo $_SESSION['remove'];
               unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
               unset($_SESSION['delete']);
            }
            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
               unset($_SESSION['update']);
            }
            
            ?>
            <br><br>
            <a class="btn-primary" href="<?php echo SITEURL;?>admin/add-food.php">Add Food</a>
            <br/><br/><br>

            <table class="tbl-full">
                <tr>
                    <th>S. N</th>
                    <th>Title</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Action</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT * FROM tbl_food";
                $res = mysqli_query($conn,$sql);
                $count = mysqli_num_rows($res);
                $sn=1;
                if($count>0)
                {
                    while($row=mysqli_fetch_assoc($res)){
                        $id = $row['id'];
                        $title =$row['title'];

                        // $description = $_POST['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        echo'
                        <tr>
                            <td>'.$sn++.'</td>
                            <td>'.$title.'</td>
                            <td>'.$price.'</td>
                            <td>';

                            if($image_name !=""){
                            echo' <img src="'.SITEURL.'images/food/'.$image_name.'" width="100px">';

                            }
                            else{
                                echo '<div class="error">Image Not Add</div>';
                            }
                            
                            echo'</td>
                            <td>'.$featured.'</td>
                            <td>'.$active.'</td>
                            <td>
                                <a class="btn-secondary" href="'.SITEURL.'admin/update-food.php?id='.$id.'">Update</a>
                                <a class="btn-danger" href="'.SITEURL.'admin/delete-food.php?id='.$id.'&image_name='.$image_name.'">Delete</a>
                            </td>
                        </tr>';

                    }
                }
                else{
                    echo '<tr><td colspan="7" class="error">Food Not added yet</td></tr>';
                }
                ?>

            </table>
           
            <div class="clearfix"></div>

        </div>
    </div>

<?php include('partials/footer.php')?>