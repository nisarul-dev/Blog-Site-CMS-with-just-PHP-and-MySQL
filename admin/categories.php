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
                        <th class="text-center">Refactor Category</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $cat_table = $connection->query("SELECT * FROM categories");
                    $i=0;
                    while ( $cat_table_obj = $cat_table->fetch_object()) : ?>
                    <tr>
                        <th scope="row" class="text-center"><?php echo $cat_table_obj->cat_id; ?></th>
                        <td class="text-center"><?php echo $cat_table_obj->cat_title; ?></td>
                        <td class="text-center">
                            <form action='categories.php' method='post'>
                            <?php
                            $i++;
                            // Edit Modal Contents
                            $modal_edit_content = "
                                <input class='form-control' type='" . "text' name='" . "the_name' value='" . "{$cat_table_obj->cat_title}'>
                                <input type='text' value='{$cat_table_obj->cat_id}' name='edit_id' style='display: none;'>
                            ";
                            modal("edit" . $i,"Edit", "Edit Category Name", $modal_edit_content, "",  "", "onclick='this.closest(`form`).submit();return false;'"); ?> |
                            <?php
                            // Edit Delete Contents
                            $modal_delete_content = "Do you want to delete category \" {$cat_table_obj->cat_title} \" ?";
                            modal("delete" . $i, "Delete", "Confirmation", $modal_delete_content, "categories.php?delete=" . $cat_table_obj->cat_id, "", "", "Yes, Delete"); ?>
                            </form>
                        </td>
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
