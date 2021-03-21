<?php

if (isset($_GET['delete-comment'])) {
    $comment_id = $_GET['delete-comment'];

    $post_id = $connection->query("SELECT * FROM `comments` WHERE `comment_id` = $comment_id")->fetch_object()->comment_post_id;
    $comment_count_minus = $connection->query("UPDATE `posts` SET post_comment_count = post_comment_count-1 WHERE `posts`.`post_id` = $post_id");
    custom_query_error($comment_count_minus);


    $delete_comment = $connection->query("DELETE FROM `comments` WHERE `comments`.`comment_id` = $comment_id");

    custom_query_error($delete_comment);
    echo "<h3 class='text-warning'>The Comment #{$comment_id} Has Been Successfully Deleted.</h3>";
}
if (isset($_GET['comment_approve'])) {
    $comment_id = $_GET['comment_approve'];
    $approve_comment = $connection->query("UPDATE `comments` SET `comment_status` = 'approved' WHERE `comments`.`comment_id` = $comment_id");
    custom_query_error($approve_comment);
    echo "<h3 class='text-success'>The Comment #{$comment_id}  Has Been Approved Successfully.</h3>";
}
if (isset($_GET['comment_unapprove'])) {
    $comment_id = $_GET['comment_unapprove'];
    $unapprove_comment = $connection->query("UPDATE `comments` SET `comment_status` = 'unapproved' WHERE `comments`.`comment_id` = $comment_id");
    custom_query_error($unapprove_comment);
    echo "<h3 class='text-warning'>The Comment #{$comment_id} Has Been Unapproved Successfully.</h3>";
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
    $comments_table = $connection->query("SELECT * FROM `comments` ORDER BY comment_id DESC");
    while ($comments_table_obj = $comments_table->fetch_object()) : ?>
        <tr>
            <th scope="row"><?php echo $comments_table_obj-> comment_id  ; ?></th>
            <td><?php echo $comments_table_obj->comment_author; ?></td>
            <td><?php echo $comments_table_obj->comment_content; ?></td>
            <td><?php echo $comments_table_obj->comment_email; ?></td>
            <td><?php echo $comments_table_obj->comment_status; ?></td>
            <td><a href="../post.php?p_id=<?php echo $comments_table_obj->comment_post_id; ?>">
            <?php echo $connection->query("SELECT post_title FROM posts WHERE post_id = $comments_table_obj->comment_post_id")->fetch_object()->post_title; ?>
            </a></td>
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