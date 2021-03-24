<?php
if (isset($_POST['user-submit'])) {
    $first_name = sanitizer($_POST['first-name']);
    $last_name = sanitizer($_POST['last-name']);
    if (isset($_POST['user-role'])) {
        $user_role = sanitizer($_POST['user-role']);
    } else {
        $error['user_role'] = "User Role is not selected!";
    }
    $username = sanitizer($_POST['username']);
    $email = sanitizer($_POST['email']);
    $password = sanitizer($_POST['password']);

// //    print_r($_FILES['image']);
//    $post_image_temp = $_FILES['image']['tmp_name']; // Temporary Location (From)
//    $post_image = $_FILES['image']['name']; // File name
//    move_uploaded_file( /*From*/$post_image_temp, /*To*/"../images/$post_image");

//    echo $post_date = date(d-m-y);

    if( $first_name == null ) {
        $error['first_name'] = "First Name is empty!";
    } if ( $last_name == null ) {
        $error['last_name'] = "Last Name is empty!";
    } if ( $username == null ) {
        $error['username'] = "Username is empty!";
    } if ( $email == null ) {
        $error['email'] = "Email is empty!";
    } if ( $password == null ) {
        $error['password'] = "Password is empty!";
    }

    if ( !isset($error) ) {
        $query = "INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `rand_salt`)";
        $query .= "VALUES (NULL, '$username', '$password', '$first_name', '$last_name', '$email', '', '$user_role', '') ";
        $create_user = $connection->query($query);
        custom_query_error($create_user);

        echo "<h2 class='text-success'>User Has been Added Successfully. <a href='users.php?source-user=view'>View Users</a></h2>";
    }
}
?>

<form action="users.php?source-user=add_new" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="first-name">First Name</label>
        <input type="text" class="form-control" id="first-name" name="first-name" placeholder="Jhon" <?php echo isset($error) && isset($first_name) ? "value=\"{$first_name}\"" : "" ; ?> >
        <small class="text-danger"><?php echo isset($error['first_name']) ? $error['first_name'] : "" ; ?></small>
    </div>
    <div class="form-group">
        <label for="last-name">Last Name</label>
        <input type="text" class="form-control" id="last-name" name="last-name" placeholder="Doa" <?php echo isset($error) && isset($last_name) ? "value=\"{$last_name}\"" : "" ; ?> >
        <small class="text-danger"><?php echo isset($error['last_name']) ? $error['last_name'] : "" ; ?></small>
    </div>

    <div class="form-group">
        <div class="col-md-2">
            <label style="padding-top: 20px;" for="user-role">User Role</label>
        </div>
        <div class="col-md-10">
            <div class="radio">
                <label>
                    <input type="radio" name="user-role" id="optionsRadios1" value="admin" <?php if( isset($error) && isset($user_role) ) if( $user_role == 'admin' ) echo "checked"; ?> >
                    Admin
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="user-role" id="optionsRadios2" value="subscriber" <?php if( isset($error) && isset($user_role) ) if( $user_role == 'subscriber' ) echo "checked"; ?> >
                    Subscriber
                </label>
            </div>
            <small class="text-danger"><?php echo isset($error['user_role']) ? $error['user_role'] : "" ; ?></small>
        </div>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username" placeholder="jhon135" <?php echo isset($error) && isset($username) ? "value=\"{$username}\"" : "" ; ?> >
        <small class="text-danger"><?php echo isset($error['username']) ? $error['username'] : "" ; ?></small>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="jhondoa@email.com" <?php echo isset($error) && isset($email) ? "value=\"{$email}\"" : "" ; ?> >
        <small class="text-danger"><?php echo isset($error['email']) ? $error['email'] : "" ; ?></small>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="********">
        <small class="text-danger"><?php echo isset($error['password']) ? $error['password'] : "" ; ?></small>
    </div>

    <button type="submit" name="user-submit" class="btn btn-default">Submit</button>
</form>