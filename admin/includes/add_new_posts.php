<?php
if (isset($_POST['post-submit'])) {
    $post_title = sanitizer($_POST['post-title']);
    if ( isset( $_POST['post-category'] )) {
        $cat_id = sanitizer($_POST['post-category']);
    } else {
        $error['category'] = "Post category is no selected!";
    }
    if ( isset( $_POST['post-status'] ) ) {
        $post_status = sanitizer($_POST['post-status']);
    } else {
        $error['status'] = "Post status is empty!";
    }
    $post_author = sanitizer($_POST['post-author']);
    $post_tags = sanitizer($_POST['post-tags']);
    $main_post_text = sanitizer($_POST['main-post-text']);

//    print_r($_FILES['image']);
    $post_image_temp = $_FILES['image']['tmp_name']; // Temporary Location (From)
    $post_image = $_FILES['image']['name']; // File name
    move_uploaded_file( /*From*/$post_image_temp, /*To*/"../images/$post_image");

//    echo $post_date = date(d-m-y);
    $post_comment_count = 0;

    if( $post_title == null ) {
        $error['title'] = "Post title is empty!";
    } if ( $post_author == null ) {
        $error['author'] = "Post author is empty!";
    } if ( $post_tags == null ) {
        $error['tags'] = "Post tags is empty!";
    } if ( $post_image == null ) {
        $error['image'] = "Please Upload a Post Image.";
    }
    if ( $main_post_text == null ) {
        $error['main-post-text'] = "Post tags is empty!";
    }

    if ( !isset($error) ) {
        $create_post = $connection->query("INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comment_count`, `post_status`)
        VALUES (NULL, $cat_id, '$post_title', '$post_author', now(), '$post_image', '$main_post_text', '$post_tags', '$post_comment_count', '$post_status')");
        custom_query_error($create_post);

        echo "<h2 class='text-success'>Your Post Has Submitted Successfully. <a href='posts.php?posts=view'>View Posts</a></h2>";
    }
}
?>

<form action="posts.php?posts=add_new" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post-title">Post Title</label>
        <input type="text" class="form-control" id="post-title" name="post-title" placeholder="Post Title" <?php echo isset($error) && isset($post_title) ? "value=\"{$post_title}\"" : "" ; ?> >
        <small class="text-danger"><?php echo isset($error['title']) ? $error['title'] : "" ; ?></small>
    </div>
    <div class="form-group">
        <label for="post-category">Post Category</label>
        <select multiple class="form-control" id="post-category" name="post-category">
            <?php
            $table= $connection->query("SELECT * FROM `categories`");
            while ($row = $table->fetch_object()) :
            ?>
            <option value="<?php echo $row->cat_id; ?>" <?php if( isset($error) && isset($cat_id) ) if( $cat_id == $row->cat_id ) echo "selected"; ?> ><?php echo $row->cat_title; ?></option>
            <?php endwhile; ?>
        </select>
        <small class="text-danger"><?php echo isset($error['category']) ? $error['category'] : "" ; ?></small>
    </div>
    <div class="form-group">
        <div class="col-md-2">
            <label style="padding-top: 20px;" for="post-status">Post Status</label>
        </div>
        <div class="col-md-10">
            <div class="radio">
                <label>
                    <input type="radio" name="post-status" id="optionsRadios1" value="draft" <?php if( isset($error) && isset($post_status) ) if( $post_status == 'draft' ) echo "checked"; ?> >
                    Draft
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="post-status" id="optionsRadios2" value="published" <?php if( isset($error) && isset($post_status) ) if( $post_status == 'published' ) echo "checked"; ?> >
                    Published
                </label>
            </div>
            <small class="text-danger"><?php echo isset($error['status']) ? $error['status'] : "" ; ?></small>
        </div>
    </div>
    <div class="form-group">
        <label for="post-author">Post Author</label>
        <input type="text" class="form-control" id="post-author" name="post-author" placeholder="Post Title" <?php echo isset($error) && isset($post_author) ? "value=\"{$post_author}\"" : "" ; ?> >
        <small class="text-danger"><?php echo isset($error['author']) ? $error['author'] : "" ; ?></small>
    </div>
    <div class="form-group">
        <label for="post-image">Post Image</label>
        <input type="file" id="post-image" name="image">
        <small class="text-danger"><?php echo isset($error['image']) ? $error['image'] : "" ; ?></small>
        <p class="help-block">Select a JPEG, JPG or PNG Format.<br> Maximum File Size = 5MB</p>
    </div>
    <div class="form-group">
        <label for="post-tags">Post Tags</label>
        <input type="text" class="form-control" id="post-tags" name="post-tags" placeholder="Post Title" <?php echo isset($error) && isset($post_tags) ? "value=\"{$post_tags}\"" : "" ; ?>  >
        <small class="text-danger"><?php echo isset($error['tags']) ? $error['tags'] : "" ; ?></small>
    </div>
    <div class="form-group">
        <label for="main-post-text">Write Post:</label>
        <textarea id="main-post-text" name="main-post-text" class="form-control" rows="5" placeholder="Write here..."> <?php echo isset($error) && isset($main_post_text) ? "$main_post_text" : "" ; ?> </textarea>
        <small class="text-danger"><?php echo isset($error['main-post-text']) ? $error['main-post-text'] : "" ; ?></small>
    </div>

    <button type="submit" name="post-submit" class="btn btn-default">Submit</button>
</form>