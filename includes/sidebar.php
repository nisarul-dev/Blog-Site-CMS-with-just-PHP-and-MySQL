<div class="col-md-4">

    <!-- Blog Search Well -->
    <div class="well">
        <form action="../search.php" method="post">
            <label class="h4" for="search">Blog Search</label>
            <div class="input-group">
                <input type="text" class="form-control" id="search" name="search-text">
                <span class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="search-submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>
        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div>
            <ul class="list-unstyled">
                <?php
                $cat_table = $connection->query("SELECT * FROM categories");
                while ($cat_table_obj = $cat_table->fetch_object()) : ?>
                <li><a href="category.php?cat_id=<?php echo $cat_table_obj->cat_id; ?>&cat_title=<?php echo $cat_table_obj->cat_title; ?>"><?php echo $cat_table_obj->cat_title; ?></a> </li>
                <?php endwhile; ?>
            </ul>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widgets.php";?>

</div>