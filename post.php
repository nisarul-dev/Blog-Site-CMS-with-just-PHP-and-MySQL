<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>
<?php
$post_id = $_GET['p_id'];
$posts_table = $connection->query("SELECT * FROM posts WHERE post_id = $post_id");
$posts_table_obj = $posts_table->fetch_object();
?>
<!-- Page Content -->
<div class="container">

<div class="row">

    <!-- Blog Post Content Column -->
    <div class="col-lg-8">

        <!-- Blog Post -->

        <!-- Title -->
        <h1><?php echo $posts_table_obj->post_title; ?></h1>

        <!-- Author -->
        <p class="lead">
            by <a href="#"><?php echo $posts_table_obj->post_author; ?></a>
        </p>

        <hr>

        <!-- Date/Time -->
        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $posts_table_obj->post_date; ?></p>

        <hr>

        <!-- Preview Image -->
        <img class="img-responsive" src="images/<?php echo $posts_table_obj->post_image; ?>" alt="">

        <hr>

        <!-- Post Content -->
        <p><?php echo nl2br($posts_table_obj->post_content) ;?></p>

        <hr>

        <!-- Blog Comments -->

        <!-- Comments Form -->
        <?php include "comment.php"?>


    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php"; ?>

</div>
<!-- /.row -->
<?php include "includes/footer.php"; ?>