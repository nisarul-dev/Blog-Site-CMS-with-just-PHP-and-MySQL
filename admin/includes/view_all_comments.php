<?php
if (isset($_GET['delete-post'])) {
    $post_id = $_GET['delete-post'];
    $delete_post = $connection->query("DELETE FROM `posts` WHERE `posts`.`post_id` = $post_id");
    custom_query_error($delete_post);
    echo "<h2 class='text-warning'>The Post Has Been Successfully Deleted.</h2>";
}

?>

<table class="table table-striped">
    <thead>
    <tr>
        <th>#</th>
        <th>Author</th>
        <th>Comment</th>
        <th>Email</th>
        <th>Status</th>
        <th>In Response To</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Unapprove</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0;
    $comments_table = $connection->query("SELECT * FROM `comments`");
    while ($comments_table_obj = $comments_table->fetch_object()) : ?>
        <tr>
            <th scope="row"><?php echo $comments_table_obj-> comment_id  ; ?></th>
            <td><?php echo $comments_table_obj->comment_author; ?></td>
            <td><?php echo $comments_table_obj->comment_content; ?></td>
            <td><?php echo $comments_table_obj->comment_email; ?></td>
            <td><?php echo $comments_table_obj->comment_status; ?></td>
            <td></td>
            <td><?php echo $comments_table_obj->comment_date; ?></td>
            <td><a href="comments.php?comment_approve=<?php echo $comments_table_obj-> comment_id  ; ?>">Approve</a></td>
            <td><a href="comments.php?comment_unapprove=<?php echo $comments_table_obj-> comment_id  ; ?>">Unapprove</a></td>
            <td>
                <?php $i++; modal("delete-comment" . $i, "<i class='fa fa-trash' aria-hidden='true'></i>", "Confirmation", "Do you want to delete the comment?", "comments.php?delete-comment=" . $comments_table_obj->comment_id , "btn-danger", "", "Yes, Delete!"); ?>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>