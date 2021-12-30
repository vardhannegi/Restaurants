<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>

        <br><br>

<?php 
$id = $_GET['password'];

?>

        <form action="" method="POST">

            <table class="tbl-30">
            <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" >
                    </td>
                </tr>

                <tr>
                    <td>New Password: </td>
                    <td>
                        <input type="password" name="new_password" >
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" >
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id;?>">
                        <input type="submit" name="submit" value="Update admin" class="btn-secondary">
                    </td>
                </tr>

            </table>
        </form>

    </div>
</div>

<?php
if(isset($_POST['submit'])){


    $id = $_POST['id'];
    $current = md5($_POST['current_password']);
    $new_pass = md5($_POST['new_password']);
    $confirm_pass = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current'";
    $res = mysqli_query($conn,$sql);
    if($res==true){
        $count = mysqli_num_rows($res);
        if($count==1){
            if($new_pass==$confirm_pass){
                $sql2 = "UPDATE tbl_admin SET `password` = '$new_pass' WHERE `tbl_admin`.`id` = $id";
                $res2 = mysqli_query($conn,$sql2);
                if($res2==true){
                    $_SESSION['change-pwd'] ='<din class="success">Password Change Successfully. </din>' ;
                    header('location:'.SITEURL.'admin/manage-admin.php');
                    
                }else{
                    $_SESSION['change-pwd'] ='<din class="error">Faied To Change Password. </din>' ;
                    header('location:'.SITEURL.'admin/manage-admin.php');
                    
                }
            }
            else{
                $_SESSION['Pws-not-match'] ='<din class="error">Password Did Not Match. </din>' ;
                header('location:'.SITEURL.'admin/manage-admin.php');
                
            }

    }else{
        $_SESSION['User-not-found'] ='<din class="error">User Not Found. </din>' ;
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    }
}
?>


<?php include('partials/footer.php')?>