<?php include "includes/db.php"; ?>

<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="page-header">
            Page Heading
            <small>Secondary Text</small>
        </h1>

        <!-- Blog Post Loop -->
        <?php
        $posts_table = $connection->query("SELECT * FROM posts");
        while($posts_table_obj = mysqli_fetch_object($posts_table)) :?>
            <h2>
                <a href="#"><?php echo $posts_table_obj->post_title; ?></a>
            </h2>
            <p class="lead">
                by <a href="index.php"><?php echo $posts_table_obj->post_author; ?></a>
            </p>
            <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $posts_table_obj->post_date; ?></p>
            <hr>
            <img class="img-responsive" src="images/<?php echo $posts_table_obj->post_image; ?>" alt="">
            <hr>
            <p><?php echo $posts_table_obj->post_content; ?></p>
            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

            <hr>
        <?php endwhile; ?>

        <!-- Pager -->
<!--        <ul class="pager">-->
<!--            <li class="previous">-->
<!--                <a href="#">&larr; Older</a>-->
<!--            </li>-->
<!--            <li class="next">-->
<!--                <a href="#">Newer &rarr;</a>-->
<!--            </li>-->
<!--        </ul>-->

    </div>

    <!-- Blog Sidebar Widgets Column -->
    <?php include "includes/sidebar.php"; ?>

</div>
<!-- /.row -->
<?php include "includes/footer.php"; ?>