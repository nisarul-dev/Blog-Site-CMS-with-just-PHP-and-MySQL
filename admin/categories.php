<!-- Header -->
<?php include "includes/header.php"; ?>
<?php $filename =  basename(__FILE__, '.php'); ?>
<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

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
                <form style="margin-top: 3em;">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Add A New Category</label>
                        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Type Category Here">
                    </div>
                    <button type="submit" class="btn btn-success">Submit</button>
                </form>
            </div>
            <div class="col-lg-6">
                <table class="table">
                    <caption>Optional table caption.</caption>
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
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
<?php include "includes/footer.php"; ?>