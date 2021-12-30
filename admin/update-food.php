<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Food</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
               unset($_SESSION['update']);
            }
            
            ?>
        <br><br>


        <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_food WHERE id=$id";
            $res = mysqli_query($conn,$sql);
            $count =mysqli_num_rows($res);

            if($count==1){
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $price=$row['price'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
                $description = $row['description'];
                $current_category = $row['category_id'];
            }
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title;?>">
                    </td>
                </tr>

             
                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" col="30" row="5"  value=""><?php echo $description;?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price;?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if($current_image !=""){
                           echo' <img src="'.SITEURL.'images/food/'.$current_image.'" width="100px">';

                        }
                        else{
                            echo '<div class="error">Image Not Add</div>';
                        }
                        ?>
                       
                    </td>
                </tr>
               
                <tr>
                    <td>Select New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                
                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

                            <?php
                                $sql2 = "SELECT * FROM tbl_category WHERE active='yes'";
                                $res2 = mysqli_query($conn,$sql2);
                                $count = mysqli_num_rows($res2);
                                
                                if($count>0){
                                    while($row=mysqli_fetch_assoc($res2)){
                                        $category_id = $row['id'];

                                        $category_title =$row['title'];
                                        
                                        // echo '<option value='.$category_id.'>'.$category_title.'</option>';
                                        ?>
                                        <option <?php if($current_category==$category_id){ echo "selected";} ?> value="<?php echo $category_id?>"><?php echo $category_title?></option>
                                        <?php
                                        
                                    }
                                }
                                else{
                                    echo '<option value="0">no category</option>';
                                }
                            
                            ?>

                        </select>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="yes"){echo "checked";}?> type="radio" name="featured" value="yes">yes
                        <input <?php if($featured=="no"){echo "checked";}?> type="radio" name="featured" value="no">no

                    </td>
                </tr>


                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="yes"){echo "checked";}?> type="radio" name="active" value="yes">yes
                        <input <?php if($active=="no"){echo "checked";}?> type="radio" name="active" value="no">no

                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                        <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php
if(isset($_POST['submit']))
{
    $id = $_POST['id'];
    $title = $_POST['title'];
    $price=$_POST['price'];
    $current_image = $_POST['current_image'];
    $description = $_POST['description'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];


        if(isset($_FILES['image']['name']))
        {
            $image_name = $_FILES['image']['name'];

            if($image_name != "")
            {

                $ext = end(explode('.',$image_name));
                $image_name = "Food_name_".rand(000,999).'.'.$ext;
                $source_path = $_FILES['image']['tmp_name'];
                $destination_path = "../images/food/".$image_name;

                $upload = move_uploaded_file($source_path,$destination_path);

                if($upload==false)
                {
                    $_SESSION['upload'] = '<div class="error">Failed to upload</div>';
                    header('location:'.SITEURL.'admin/manage-food.php');
                    die();
                }
                if($current_image!="")
                {
                    $path = "../images/food/".$current_image;
                    $remove = unlink($path);
                    if($remove==false)
                    {
                        $_SESSION['failed-remove'] = '<div class="error">Failed ot Remove Image. </div>';
                        header('location:'.SITEURL.'admin/manage-food.php');
                        die();
                    }

                }
            }
            else
            {
                $image_name= $current_image;
            }
        }
       
        else
        {
            $image_name=$current_image;
        }


        $sql3 = "UPDATE `tbl_food` SET 
        `title`='$title', `image_name`='$image_name',
        `price`='$price',`description`='$description',
        `featured`='$featured', `active`='$active',
        `category_id`='$category' WHERE `tbl_food`.`id`=$id";

        $res3 = mysqli_query($conn,$sql3);
        if($res3==true){
            $_SESSION['update'] = '<div class="success">Food Added Successfully. </div>';
            header('location:'.SITEURL.'admin/manage-food.php');
        }else{
            $_SESSION['update'] = '<div class="error">Failed to Add Food. </div>';
            header('location:'.SITEURL.'admin/add-food.php');
        }


    }

?>

<?php include('partials/footer.php')?>