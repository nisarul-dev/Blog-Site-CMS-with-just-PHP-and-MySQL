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
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 0;
    $posts_table = $connection->query("SELECT * FROM `posts` ORDER BY `post_id` DESC");
    while ($posts_table_obj = $posts_table->fetch_object()) : ?>
        <tr>
            <th scope="row"><?php echo $posts_table_obj->post_id; ?></th>
            <td><?php echo $posts_table_obj->post_author; ?></td>
            <td><a href="../post.php?p_id=<?php echo $posts_table_obj->post_id; ?>"><?php echo $posts_table_obj->post_title; ?></a></td>
            <td><?php echo isset($connection->query("SELECT cat_title FROM `categories` WHERE cat_id = $posts_table_obj->post_category_id ")->fetch_object()->cat_title) ? $connection->query("SELECT cat_title FROM `categories` WHERE cat_id = $posts_table_obj->post_category_id ")->fetch_object()->cat_title : "Uncategorized"; ?></td>
            <td><?php echo $posts_table_obj->post_status; ?></td>
            <td><img class="img-responsive" width="150" src="../images/<?php echo $posts_table_obj->post_image ; ?>" alt="images"></td>
            <td><?php echo $posts_table_obj->post_tags; ?></td>
            <td><?php echo $posts_table_obj->post_comment_count; ?></td>
            <td><?php echo $posts_table_obj->post_date; ?></td>
            <td>
                <a style="color: black; font-size: 1.65em;" href='posts.php?posts=edit&p_id=<?php echo $posts_table_obj->post_id;?>'><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            </td><td>
                <?php $i++; modal("delete-post" . $i, "<i class='fa fa-trash' aria-hidden='true'></i>", "Confirmation", "Do you want to delete the post?", "posts.php?delete-post=" . $posts_table_obj->post_id , "btn-danger", "", "Yes, Delete!"); ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>