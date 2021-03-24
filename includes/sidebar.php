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
    <!-- Blog Search Well -->
    <div class="well">
    <?php if(!isset($_SESSION['username'])) : ?>
        <h4>Log In</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" id="login_username" name="login_username" placeholder="Enter Username or Email" <?php echo isset($_GET['username']) ? "value=\"{$_GET['username']}\"" : "" ; ?> >
                <small class="text-danger"><?php echo isset($_GET['username-error']) ? $_GET['username-error'] : "" ; ?></small>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="login_password" name="login_password" placeholder="Password">
                <small class="text-danger"><?php echo isset($_GET['password-error']) ? $_GET['password-error'] : "" ; ?></small>
            </div>
            <input type="submit" class="btn btn-block btn-success" name="login_submit" value="Log in">
        </form>
        <!-- /.input-group -->
    <?php else: ?>
        <h4 style="display: inline; overflow: hidden; padding: 0 0;">Welcome, <?php echo $_SESSION['firstname']; ?></h4>
        <a style="float: right; position: relative; bottom: 8px;" href="admin/includes/logout.php" class="btn btn-danger">Logout</a>
    <?php endif; ?>
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