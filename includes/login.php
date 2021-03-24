<?php
if (isset($_POST['login_submit'])) {
    include "db.php";
    include "../functions.php";

    $login_username = sanitizer($_POST['login_username']);
    $login_password = sanitizer($_POST['login_password']);

    if ($login_username == null) {
        $error["login_username"] = "The+username+is+empty";
    } if ($login_password == null) {
        $error["login_password"] = "The+password+is+empty";
    } if (isset($error)) {
        header ("Location: ../index.php?username-error={$error["login_username"]}&password-error={$error["login_password"]}&username={$login_username}");
    }

    if (!isset($error)) {
        $user_data_table = $connection->query("SELECT * FROM users WHERE username = '$login_username' OR user_email = '$login_username'; ");
        if ( $user_data_table->num_rows > 0 ) {
            $user_data_table_obj = $user_data_table->fetch_object();
            $user_id = $user_data_table_obj->user_id;
            $user_name = $user_data_table_obj->username;
            $user_email = $user_data_table_obj->user_email;
            $user_password = $user_data_table_obj->user_password;
            $user_first_name = $user_data_table_obj->user_firstname;
            $user_last_name = $user_data_table_obj->user_lastname;

            if ( ($user_name === $login_username || $user_email === $login_username) && $user_password == $login_password) {

                session_start();
                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $user_name;
                $_SESSION['firstname'] = $user_first_name;
                $_SESSION['lastname'] = $user_last_name;
                $_SESSION['user_email'] = $user_email;

                header ("Location: ../admin");

            } else {
                header ("Location: ../index.php?password-error=Username+or+Password+is+incorrect+!&username={$login_username}");
            }
        }
    }

}
?>