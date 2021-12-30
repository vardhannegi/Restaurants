<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            // if(isset($_SESSION['upload'])){
            //     echo $_SESSION['upload'];
            //     unset($_SESSION['upload']);
            // }
            
            ?>
        <br><br>
        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" col="30" row="5"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">



                            <?php
                                $sql = "SELECT * FROM tbl_category WHERE active='yes'";
                                $res = mysqli_query($conn,$sql);
                                $count = mysqli_num_rows($res);
                                
                                if($count>0){
                                    while($row=mysqli_fetch_assoc($res)){
                                        $id = $row['id'];

                                        $title =$row['title'];
                                        
                                        echo '<option value='.$id.'>'.$title.'</option>';
                                    }
                                }
                                else{
                                    echo '<option value="0">no category</option>';
                                }
                            
                            ?>

                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="yes">Yes
                        <input type="radio" name="featured" value="no">No

                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="yes">Yes
                        <input type="radio" name="active" value="no">No

                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>
    </div>
</div>

<?php
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    if(isset($_POST['featured']))
    {
        $featured = $_POST['featured'];
    }else{
        $featured = "No";
    }
    if(isset($_POST['active']))
    {
        $active = $_POST['active'];
    }else{
        $active = "No";
    }

    if(isset($_FILES['image']['name'])){
        $image_name = $_FILES['image']['name'];

        if($image_name != ""){

            $ext = end(explode('.',$image_name));
            $image_name = "Food_name_".rand(000,999).'.'.$ext;
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/".$image_name;

            $upload = move_uploaded_file($source_path,$destination_path);

            if($upload==false){
            $_SESSION['upload'] = '<div class="error">Failed to upload</div>';
                header('location:'.SITEURL.'admin/add-food.php');
                die();
            }
    }

    }else{
        $image_name ="";
    }

    $sql = "INSERT INTO `tbl_food` (`title`, `description`,`price`,`image_name`,`category_id`,`featured`, `active`) 
    VALUES ('$title','$description','$price', '$image_name','$category','$featured', '$active')";

    $res = mysqli_query($conn,$sql);
    if($res==true){
        $_SESSION['add'] = '<div class="success">Food Added Successfully. </div>';
        header('location:'.SITEURL.'admin/manage-food.php');
    }else{
        $_SESSION['add'] = '<div class="error">Failed to Add Food. </div>';
        header('location:'.SITEURL.'admin/add-food.php');
    }


}
?>

<?php include('partials/footer.php')?>