<?php
if(isset($_POST['comment-submit'])) {
    $post_id = $_GET['p_id'];
    $author = sanitizer($_POST['author']);
    $email =  sanitizer($_POST['email']);
    $main_comment = sanitizer($_POST['main-comment']);

    if($author == NULL) {
        $error['author'] = "Please enter your name.";
    } if ($email == null) {
        $error['email'] = "Please enter your email.";
    } if ($main_comment == null) {
        $error['main_comment'] = "The comment box is empty!";
    }

    if (!isset($error)) {
        $create_comment = $connection->query("INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`)
        VALUES (NULL, '$post_id', '$author', '$email', '$main_comment', 'unapproved', '2021-03-20')");
        custom_query_error($create_comment);

        $comment_count_plus = $connection->query("UPDATE `posts` SET post_comment_count = post_comment_count+1 WHERE `posts`.`post_id` = $post_id");
        custom_query_error($comment_count_plus);
    }

}
?>

<div class="well">
    <h4>Leave a Comment:</h4>
    <form action="post.php?p_id=<?php echo $_GET['p_id']?>#form" method="post" role="form" id="form">
        <div class="form-group">
            <label for="author">Author</label>
            <input class="form-control" type="text" name="author" id="author" value="<?php echo isset($error) ? $author : ""; ?>">
            <p class="text-danger"><?php echo isset($error['author']) ? $error['author'] : ""; ?></p>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input class="form-control" type="email" name="email" id="email" value="<?php echo isset($error) ? $email : "";; ?>">
            <p class="text-danger"><?php echo isset($error['email']) ? $error['email'] : ""; ?></p>
        </div>
        <div class="form-group">
            <label for="main-comment">Comment</label>
            <textarea id="main-comment" name="main-comment" class="form-control" rows="3"><?php echo isset($error) ? $main_comment : ""; ?></textarea>
            <p class="text-danger"><?php echo isset($error['main_comment']) ? $error['main_comment'] : ""; ?></p>
        </div>
        <button type="submit" name="comment-submit" class="btn btn-primary">Submit</button>
        <br>
        <br>
        <p class="text-success"><?php echo isset($_POST['comment-submit']) ? "Your comment is waiting for approval!" : ""; ?></p>
    </form>
</div>

<hr>

<!-- Posted Comments -->

<!-- Comment -->
<?php
$post_id = $_GET['p_id'];
$comment_table = $connection->query("SELECT * FROM comments WHERE comment_post_id = $post_id AND comment_status = 'approved'");
while($comment_table_obj = $comment_table->fetch_object()) : ?>
<div class="media">
    <a class="pull-left" href="#">
        <img class="media-object" src="images/Profile_avatar_placeholder_large.png" height="64" width="64" alt="">
    </a>
    <div class="media-body">
        <h4 class="media-heading"><?php echo $comment_table_obj->comment_author; ?>
            <small><?php echo $comment_table_obj->comment_date; ?></small>
        </h4>
        <?php echo $comment_table_obj->comment_content; ?>
    </div>
</div>
<?php endwhile; ?>