<!-- Header -->
<?php include "includes/admin_header.php"; ?>
<?php $filename =  basename(__FILE__, '.php'); ?>
<!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

<?php
    if (isset($_POST['cat-submit'])) {
        $cat_name = $_POST['cat-text'];
        // Sanitizing the input
        $cat_name = filter_var($cat_name, FILTER_SANITIZE_STRING);
        $cat_name = trim($cat_name);
        $cat_name = $connection->real_escape_string($cat_name);

        if ($cat_name == null) {
            $cat_submit_error = "The category name field cannot be empty!";
        } else if ( $connection->query("SELECT cat_title FROM categories WHERE cat_title = '$cat_name'")->num_rows > 0 ) {
            $cat_submit_error = "The category \" {$cat_name} \" already exits!";
        }  else {
            $connection->query("INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES (NULL, '$cat_name') ");
        }
    }

?>

<div id="page-wrapper">

    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Welcome to Admin Dashboard,
                    <small>Author</small>
                </h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <form style="margin-top: 3em;" action="categories.php" method="post">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Add A New Category</label>
                        <input type="text" class="form-control" id="cat-text" name="cat-text" placeholder="Type Category Here">
                        <p class="text-danger"><?php echo isset($cat_submit_error) ? $cat_submit_error : ""; ?></p>
                    </div>
                    <button type="submit" name="cat-submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-lg-6 table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr class="bg-primary">
                        <th class="text-center">#</th>
                        <th class="text-center">Category Name</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $cat_table = $connection->query("SELECT * FROM categories");
                    while ( $cat_table_obj = $cat_table->fetch_object()) : ?>
                    <tr>
                        <th scope="row" class="text-center"><?php echo $cat_table_obj->cat_id; ?></th>
                        <td class="text-center"><?php echo $cat_table_obj->cat_title; ?></td>
                    </tr>
                    <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
<!-- /#page-wrapper -->

<!-- Footer -->
<?php include "includes/admin_footer.php"; ?>