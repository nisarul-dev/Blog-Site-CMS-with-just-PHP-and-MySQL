<table class="table table-striped">
    <thead>
    <tr>
        <th>#id</th>
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
    <?php
    $posts_table = $connection->query("SELECT * FROM `posts`");
    while ($posts_table_obj = $posts_table->fetch_object()) : ?>
        <tr>
            <th scope="row"><?php echo $posts_table_obj->post_id; ?></th>
            <td><?php echo $posts_table_obj->post_author; ?></td>
            <td><?php echo $posts_table_obj->post_title; ?></td>
            <td><?php echo $connection->query("SELECT cat_title FROM `categories` WHERE cat_id = $posts_table_obj->post_category_id ")->fetch_object()->cat_title; ?></td>
            <td><?php echo $posts_table_obj->post_status; ?></td>
            <td><img class="img-responsive" width="150" src="../images/<?php echo $posts_table_obj->post_image ; ?>" alt="images"></td>
            <td><?php echo $posts_table_obj->post_tags; ?></td>
            <td><?php echo $posts_table_obj->post_comment_count; ?></td>
            <td><?php echo $posts_table_obj->post_date; ?></td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>