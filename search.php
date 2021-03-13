<?php
if (!isset($_POST['search-submit'])) {
    header("Location: index.php");
}
$searched_text = $_POST['search-text'];
include "includes/header.php"; ?>
    <!-- Navigation -->
<?php include "includes/navigation.php"; ?>

    <!-- Page Content -->
    <div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="page-header">
                Searching For: <?php echo $searched_text; ?>
                <small>&rarr; <?php
                    $searched_posts_table = $connection->query("SELECT * FROM posts WHERE post_tags LIKE '%$searched_text%' OR post_author LIKE '%$searched_text%' OR post_content LIKE '%$searched_text%'");
                    echo $searched_posts_table->num_rows;
                    ?> Result<?php if($searched_posts_table->num_rows > 1) { echo "s"; } ?></small>
            </h1>

            <!-- Blog Post Loop -->
            <?php

            while($searched_posts_table_obj = $searched_posts_table->fetch_object()) :?>
                <h2>
                    <a href="#"><?php echo $searched_posts_table_obj->post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $searched_posts_table_obj->post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $searched_posts_table_obj->post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $searched_posts_table_obj->post_image; ?>" alt="">
                <hr>
                <p><?php echo $searched_posts_table_obj->post_content; ?></p>
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