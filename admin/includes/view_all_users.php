<?php
if (isset($_GET['delete-user'])) {
    $user_id = $_GET['delete-user'];
    $delete_user = $connection->query("DELETE FROM `users` WHERE `users`.`user_id` = $user_id");
    custom_query_error($delete_user);
    echo "<h2 class='text-warning'>The User #{$user_id} Has Been Successfully Deleted.</h2>";
}

if (isset($_GET['change_role_to_subscriber_id'])) {
    $user_id = $_GET['change_role_to_subscriber_id'];
    $change_user = $connection->query("UPDATE `users` SET `user_role` = 'subscriber' WHERE `users`.`user_id` = $user_id ");
    custom_query_error($change_user);
    echo "<h2 class='text-warning'>The User Role of #{$user_id} Has Been Successfully Changed To Subscriber.</h2>";
}

if (isset($_GET['change_role_to_admin_id'])) {
    $user_id = $_GET['change_role_to_admin_id'];
    $change_user = $connection->query("UPDATE `users` SET `user_role` = 'admin' WHERE `users`.`user_id` = $user_id ");
    custom_query_error($change_user);
    echo "<h2 class='text-warning'>The User Role of #{$user_id} Has Been Successfully Changed To Admin.</h2>";
}

?>

<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Username</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Change Role</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0;
    $users_table = $connection->query("SELECT * FROM `users` ORDER BY `user_id` DESC");
    while ($users_table_obj = $users_table->fetch_object()) : ?>
        <tr>
            <th scope="row"><?php echo $users_table_obj->user_id; ?></th>
            <td><?php echo $users_table_obj->username; ?></td>
            <!-- <td><?php //echo isset($connection->query("SELECT cat_title FROM `categories` WHERE cat_id = $posts_table_obj->post_category_id ")->fetch_object()->cat_title) ? $connection->query("SELECT cat_title FROM `categories` WHERE cat_id = $posts_table_obj->post_category_id ")->fetch_object()->cat_title : "Uncategorized"; ?></td> -->
            <td><?php echo $users_table_obj->user_firstname; ?></td>
            <td><?php echo $users_table_obj->user_lastname; ?></td>
            <!-- <td><img class="img-responsive" width="150" src="../images/<?php //echo $users_table_obj->user_image ; ?>" alt="images"></td> -->
            <td><?php echo $users_table_obj->user_email; ?></td>
            <td style="text-transform: capitalize;"><?php echo $users_table_obj->user_role; ?></td>
            <td>
            <?php if($users_table_obj->user_role == "admin") : ?>
                <a href="users.php?source-user=view&change_role_to_subscriber_id=<?php echo $users_table_obj->user_id; ?>">Change to Subscriber</a>
                <?php else: ?>
                <a href="users.php?source-user=view&change_role_to_admin_id=<?php echo $users_table_obj->user_id; ?>">Change to Admin</a>
            <?php endif; ?>
            </td>
            <td>
                <a style="color: black; font-size: 1.65em;" href='users.php?source-user=edit&user_id=<?php echo $users_table_obj->user_id;?>'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            </td>
            <td>
                <?php $i++; modal("delete-user" . $i, "<i class='fa fa-trash' aria-hidden='true'></i>", "Confirmation", "Do you want to delete the user?", "users.php?delete-user=" . $users_table_obj->user_id , "btn-danger", "", "Yes, Delete!"); ?>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>