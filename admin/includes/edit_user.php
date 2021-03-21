<?php
$the_user_id = $_GET['user_id'];

if (isset($_POST['user-update'])) {
    $first_name = sanitizer($_POST['first-name']);
    $last_name = sanitizer($_POST['last-name']);
    if (isset($_POST['user-role'])) {
        $user_role = sanitizer($_POST['user-role']);
    } else {
        $error['user_role'] = "User Role is not selected!";
    }
    $username = sanitizer($_POST['username']);
    $email = sanitizer($_POST['email']);

//    print_r($_FILES['image']);
//    if ($_FILES['image']['size'] > 0) {
//        $post_image_temp = $_FILES['image']['tmp_name']; // Temporary Location (From)
//        $post_image = $_FILES['image']['name']; // File name
//        move_uploaded_file( /*From*/$post_image_temp, /*To*/"../images/$post_image");
//    } else {
//        $post_image = $connection->query("SELECT * FROM `posts` WHERE `post_id`= $the_post_id")->fetch_object()->post_image;
//    }

//    echo $post_date = date(d-m-y);

    if( $first_name == null ) {
        $error['first_name'] = "First Name is empty!";
    } if ( $last_name == null ) {
        $error['last_name'] = "Last Name is empty!";
    } if ( $username == null ) {
        $error['username'] = "Username is empty!";
    } if ( $email == null ) {
        $error['email'] = "Email is empty!";
    }

    if ( !isset($error) ) {
        $update_post = $connection->query("UPDATE `users` SET `username` = '$username', `user_firstname` = '$first_name', `user_lastname` = '$last_name', `user_email` = '$email', `user_role` = '$user_role' WHERE `users`.`user_id` = $the_user_id ");
        custom_query_error($update_post);
        echo "<h2 class='text-success'>The User Data Has been Updated Successfully. <a href='users.php?source-user=view'>View Posts</a></h2>";
    }
}

$the_user_table = $connection->query("SELECT * FROM users WHERE user_id = $the_user_id");
$the_user_table_obj = $the_user_table->fetch_object();
$the_user_first_name = $the_user_table_obj->user_firstname;
$the_user_last_name = $the_user_table_obj->user_lastname;
$the_user_role = $the_user_table_obj->user_role;
$the_username= $the_user_table_obj->username;
$the_user_email = $the_user_table_obj->user_email;
?>


<form action="users.php?source-user=edit&user_id=<?php echo $the_user_id; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="first-name">First Name</label>
        <input type="text" class="form-control" id="first-name" name="first-name" value="<?php echo $the_user_first_name; ?>">
        <small class="text-danger"><?php echo isset($error['first_name']) ? $error['first_name'] : "" ; ?></small>
    </div>
    <div class="form-group">
        <label for="last-name">Last Name</label>
        <input type="text" class="form-control" id="last-name" name="last-name" value="<?php echo $the_user_last_name; ?>">
        <small class="text-danger"><?php echo isset($error['last_name']) ? $error['last_name'] : "" ; ?></small>
    </div>

    <div class="form-group">
        <div class="col-md-2">
            <label style="padding-top: 20px;" for="user-role">User Role</label>
        </div>
        <div class="col-md-10">
            <div class="radio">
                <label>
                    <input type="radio" name="user-role" id="optionsRadios1" value="admin" <?php echo $the_user_role == "admin" ? "checked": "" ; ?> >
                    Admin
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="user-role" id="optionsRadios2" value="subscriber" <?php echo $the_user_role == "subscriber" ? "checked": "" ; ?> >
                    Subscriber
                </label>
            </div>
            <small class="text-danger"><?php echo isset($error['user_role']) ? $error['user_role'] : "" ; ?></small>
        </div>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo $the_username; ?>" >
        <small class="text-danger"><?php echo isset($error['username']) ? $error['username'] : "" ; ?></small>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $the_user_email; ?>">
        <small class="text-danger"><?php echo isset($error['email']) ? $error['email'] : "" ; ?></small>
    </div>

    <button type="submit" name="user-update" class="btn btn-default">Update</button>
</form>