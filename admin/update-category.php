<?php include('partials/menu.php')?>
<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            // if(isset($_SESSION[''])){
            //     echo $_SESSION[''];
            //     unset($_SESSION['']);
            // }
            
            ?>
        <br><br>


        <?php
        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $sql = "SELECT * FROM tbl_category WHERE id=$id";
            $res = mysqli_query($conn,$sql);
            $count =mysqli_num_rows($res);

            if($count==1){
                $row = mysqli_fetch_assoc($res);
                $title = $row['title'];
                $current_image = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
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
                    <td>Current Image: </td>
                    <td>
                        <?php
                        if($current_image !=""){
                           echo' <img src="'.SITEURL.'images/category/'.$current_image.'" width="100px">';

                        }
                        else{
                            echo '<div class="error">Image Not Add</div>';
                        }
                        ?>
                       
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

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
        $image_name = "Food_category_".rand(000,999).'.'.$ext;
        $source_path = $_FILES['image']['tmp_name'];
        $destination_path = "../images/category/".$image_name;

        $upload = move_uploaded_file($source_path,$destination_path);

        if($upload==false){
           $_SESSION['upload'] = '<div class="error">Failed to upload</div>';
            header('location:'.SITEURL.'admin/manage-category.php');
            die();
        }
        if($current_image!=""){
            $path = "../images/category/".$current_image;
            $remove = unlink($path);
            if($remove==false){
                $_SESSION['failed-remove'] = '<div class="error">Failed ot Remove Image. </div>';
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }

        }

       
    }
    else{
        $image_name= $current_image;
    }

    }else{
        $image_name ="";
    }

    $sql = "UPDATE `tbl_category` SET 
    `title`='$title', `image_name`='$image_name',
    `featured`='$featured', `active`='$active' 
    WHERE `tbl_category`.`id`=$id";

    $res = mysqli_query($conn,$sql);
    if($res==true){
        $_SESSION['add'] = '<div class="success">Category Added Successfully. </div>';
        header('location:'.SITEURL.'admin/manage-category.php');
    }else{
        $_SESSION['add'] = '<div class="error">Failed to Add Category. </div>';
        header('location:'.SITEURL.'admin/add-category.php');
    }


}
?>

<?php include('partials/footer.php')?>