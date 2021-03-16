<!-- Header -->
<?php include "includes/admin_header.php"; ?>
<?php $filename =  basename(__FILE__, '.php'); ?>
<?php code_of_categories(); ?>
<!-- Navigation -->
<?php include "includes/admin_navigation.php"; ?>

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
                        <label for="cat-text">Add A New Category</label>
                        <input type="text" class="form-control" id="cat-text" name="cat-text" placeholder="Type Category Here">
                        <p class="text-danger"><?php echo isset($cat_submit_error) ? $cat_submit_error : ""; ?></p>
                    </div>
                    <button type="submit" name="cat-submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="col-lg-6 table-responsive">
            <p class="text-danger"><?php echo isset($cat_rename_error) ? $cat_rename_error : ""; ?></p>
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                    <tr class="bg-primary">
                        <th class="text-center">#</th>
                        <th class="text-center">Category Name</th>
                        <th class="text-center">Refactor Category</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php category_table_maker(); ?>
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
