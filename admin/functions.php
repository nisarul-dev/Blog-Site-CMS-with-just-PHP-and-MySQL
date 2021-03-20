<?php

// Creating a modal
function modal( $id, $btn_title, $modal_title, $modal_content, $modal_yes_btn_link, $btn_style = "btn btn-primary", $modal_yes_btn_attr = "", $modal_yes_btn_text = "Save changes" ) { ?>
    <!-- Button trigger modal -->
    <button type="button" class="<?php echo $btn_style; ?>" data-toggle="modal" data-target="#<?php echo $id; ?>">
        <?php echo $btn_title; ?>
    </button>

    <!-- Modal -->
    <div class="modal fade" id="<?php echo $id; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel"><?php echo $modal_title; ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $modal_content; ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <a href="<?php echo $modal_yes_btn_link; ?>" <?php echo $modal_yes_btn_attr; ?> class="btn btn-primary"><?php echo $modal_yes_btn_text; ?></a>
                </div>
            </div>
        </div>
    </div>
<?php }

// Sanitizing Variables
function sanitizer($text) {
    global $connection;
    $text = filter_var($text, FILTER_SANITIZE_STRING);
    $text = trim($text);
    return $text = $connection->real_escape_string($text);
}




function code_of_categories() {
    global $connection, $cat_submit_error, $cat_rename_error;
    // Adding a Category
    if (isset($_POST['cat-submit'])) {
        $cat_name = $_POST['cat-text'];
        // Sanitizing the input
        $cat_name = sanitizer($cat_name);

        if ($cat_name == null) {
            $cat_submit_error = "The category name field cannot be empty!";
        } else if ( $connection->query("SELECT cat_title FROM categories WHERE cat_title = '$cat_name'")->num_rows > 0 ) {
            $cat_submit_error = "The category \" {$cat_name} \" already exits!";
        }  else {
            $connection->query("INSERT INTO `categories` (`cat_id`, `cat_title`) VALUES (NULL, '$cat_name') ");
        }
    }

    // Deleting a Category
    if( isset($_GET['delete-category']) ) {
        $cat_id = $_GET['delete-category'];
        $connection->query("DELETE FROM `categories` WHERE `categories`.`cat_id` = $cat_id");
    }

    // Updating a Category
    if(isset($_POST['the_name'])) {
        $new_cat_name = $_POST['the_name'];
        $cat_edit_id = $_POST['edit_id'];

        if ( $connection->query("SELECT cat_title FROM categories WHERE cat_title = '$new_cat_name'")->num_rows > 0 ) {
            echo $cat_rename_error = "Cannot rename to \" {$new_cat_name} \". Because, the category \" {$new_cat_name} \" already exits!";
        } else {
            $connection->query("UPDATE `categories` SET `cat_title` = '$new_cat_name' WHERE `categories`.`cat_id` = $cat_edit_id ");
        }
    }
}


function category_table_maker() {
    global $connection;
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
                    modal("delete" . $i, "Delete", "Confirmation", $modal_delete_content, "category.php?delete-category=" . $cat_table_obj->cat_id, "", "", "Yes, Delete"); ?>
                </form>
            </td>
        </tr>
    <?php endwhile;
}

// Custom Query Error
function custom_query_error($the_query) {
    global $connection;
    if(!$the_query) {
        die("QUERY FAILED: " . mysqli_error($connection));
    }
}

