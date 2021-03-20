<?php include "includes/header.php"; ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

<div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

        <h1 class="page-header">
            Welcome to the CMS
            <small>Created by Nisarul</small>
        </h1>

        <!-- Blog Post Loop -->
        <div class="row">
        <?php
        $posts_table = $connection->query("SELECT * FROM posts WHERE post_status = 'published'");
        while($posts_table_obj = mysqli_fetch_object($posts_table)) :?>
            <div class="col-md-12" >
                <div class="thumbnail" style="box-shadow: #5e5e5e 2px 2px 10px">
                    <img class="img-responsive" src="images/<?php echo $posts_table_obj->post_image; ?>" alt="">
                    <div class="caption">
                        <h2><a href="post.php?p_id=<?php echo $posts_table_obj->post_id; ?>"><?php echo $posts_table_obj->post_title; ?></a></h2>
                        <p class="lead">
                            by <a href="index.php"><?php echo $posts_table_obj->post_author; ?></a>
                        </p>
                        <p><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $posts_table_obj->post_date; ?></p>
                        <p><?php echo substr($posts_table_obj->post_content, 0, 100) . " ..."; ?></p>
                        <p><a class="btn btn-primary" role="button" href="post.php?p_id=<?php echo $posts_table_obj->post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
        </div>

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