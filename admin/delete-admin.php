
<?php
include('../config/constants.php');

if(isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];

    $sql = "DELETE FROM tbl_admin WHERE id=$id";
    $res = mysqli_query($conn,$sql);

    if($res==TRUE){
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully </div>";
        // $_SESSION['delete'] = "Admin Deleted Successfully";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else{
        $_SESSION['dalete'] = "Failed To Delet Admin";
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
}
?>