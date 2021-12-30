<?php include('partials/menu.php')?>

<!-- 
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Update</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="hidden" name="postid1" id="postid1">
                            <label for="editInputEmail1">Full Name</label>
                            <input type="text" class="form-control" name="statusupdate" id="editInputEmail1"
                                aria-describedby="emailHelp">
                            <label for="editInputEmail1">Username</label>
                            <input type="text" class="form-control" name="username" id="editInputEmail1"
                                aria-describedby="emailHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 -->

<div class="main-content">
    <div class="wrapper">
        <h1>MANAGE-ADMIN</h1>
        <br>
        <?php
            if(isset($_SESSION['add'])){
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }
            if(isset($_SESSION['delete'])){
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update'])){
                echo $_SESSION['update'];
               unset($_SESSION['update']);
            }

            if(isset($_SESSION['change-pwd'])){
                echo $_SESSION['change-pwd'];
               unset($_SESSION['change-pwd']);
            }
            if(isset($_SESSION['Pws-not-match'])){
                echo $_SESSION['Pws-not-match'];
               unset($_SESSION['Pws-not-match']);
            }
            if(isset($_SESSION['User-not-found'])){
                echo $_SESSION['User-not-found'];
               unset($_SESSION['User-not-found']);
            }
            
            ?>
        <br><br><br>


        <a class="btn-primary" href="add-admin.php">Add Admin</a>

        <br><br /><br>

        <table class="tbl-full">
            <tr>
                <th>S. N</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>

            <?php
                $sql = "SELECT *FROM tbl_admin";
                $res = mysqli_query($conn,$sql);
                if($res==TRUE){
                    $sn=1;
                    $row = mysqli_num_rows($res);
                    if($row>0){
                        while($row=mysqli_fetch_assoc($res)){
                            $id = $row['id'];
                            $full_name = $row['full_name'];
                            $username  = $row['username'];

                            echo '
                            <tr>
                            <td>'.$sn++.'</td>
                            <td>'.$full_name.'</td>
                            <td>'.$username.'</td>
                            <td>
                                <a class="btn-secondary" href="'.SITEURL.'admin/update-password.php?password='.$id.'">Chang Password</a>
                                <a class="btn-secondary" href="'.SITEURL.'admin/update-admin.php?update='.$id.'">Update</a>
                                <a class="btn-danger" href="'.SITEURL.'admin/delete-admin.php?delete_id='.$id.'">Delete</a>
                            </td>
                        </tr>
                            ';
                        }
                    }else{

                    }
                }                
                
                ?>


        </table>

        <div class="clearfix"></div>

    </div>
</div>



<?php
    
//     if(isset($_POST['postid1'])){
//     $full_name = $_POST['statusupdate'];
//     $username = $_POST['username'];

//     $post1 = $_POST['postid1'];

//     $sql = "UPDATE `tbl_admin` SET `full_name` = '$full_name', `username` = '$username' WHERE `tbl_admin`.`id` = $post1";
//     $result = mysqli_query($conn,$sql);
//     if($res==true){
//         $_SESSION['update'] = '<div class="success">Admin Updated Successfully.</div>';
//         // header('location:'.SITEURL.'admin/manage-admin.php');
//     }
//     else{
//         $_SESSION['update'] = '<div class="success">Failed To Updated.</div>';
//         // header('location:'.SITEURL.'admin/manage-admin.php');                
//     }
// }
?>


<!-- <button class="btn-secondary1 edit" id='.$id.'>Update</button> -->

<?php include('partials/footer.php')?>