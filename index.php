    <!-- Some php code-->
    <?php
    require_once 'process.php';
    ?>

    <?php
    $result = $mysqli->query("SELECT * FROM tblcrud") or die($mysqli->error);
    ?>
    <!-- /Some php code-->


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta fname="viewport" content="width=device-width, initial-scale=1.0">
        <title>CRUD</title>
        <link rel="stylesheet" href="./bootstrap/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">

    </head>

    <body>

        <!--header-->
        <header class="header-main">
            <div class="row justify-content-center name-text">
                <a href="index.php">
                    Table of People
                </a>
            </div>
        </header>
        <!--/header-->
        <!---------------------------------------------------------------------------------------------------------------->
        <!--Alert Session-->
        <?php
        if (isset($_SESSION['message'])) :
        ?>
            <div class="alert alert-<?= $_SESSION['msg_type'] ?>">
                <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
                ?>
            </div>
        <?php endif ?>
        <!--/Alert Session-->
        <!---------------------------------------------------------------------------------------------------------------->
        <!-- The middle content-->
        <div class="row container-fluid main-row">
            <!---------------------------------------------------------------------------------------------------------------->
            <!-- Main Content-->
            <div class="col-3 main-content">

                <form action="process.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <div class="form-group">
                        <input class="form-control" type="text" name="fname" i
                        d="" value="<?php echo $fname ?>" placeholder="First Name">
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="text" name="lname" 
                        id="" value="<?php echo $lname ?>" placeholder="Last Name">
                    </div>

                    <div class="form-group">
                        <input class="form-control" type="text" name="email" 
                        id="" value="<?php echo $email ?>" placeholder="Email">
                    </div>


                    <div class="form-group">

                        <?php
                        if ($update == true) : ?>
                            <button type="submit" class="btn btn-info my-btn" name="update">Update</button>
                        <?php else : ?>
                            <button type="submit" class="btn btn-primary my-btn" name="save">Save</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
            <!-- /Main Content-->

            <!---------------------------------------------------------------------------------------------------------------->
            <!-- Table content -->
            <div class="col-9 table-content">
                <table class="table">
                    <thead>
                        <tr>
                    
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th colspan="1">Action</th>

                        </tr>
                    </thead>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                          
                            <td><?php echo $row["id"]; ?> </td>
                            <td><?php echo $row["fname"]; ?> </td>
                            <td><?php echo $row["lname"]; ?> </td>
                            <td><?php echo $row["email"]; ?> </td>
                            <td class="btn-action">
                                <a href="index.php?edit=<?php echo $row['id'] ?>" class="btn btn-info">Edit</a>
                                <a href="process.php?delete=<?php echo $row['id'] ?>" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
            <!--/Table content-->

        </div>
        <!-- /The middle content-->

        <!---------------------------------------------------------------------------------------------------------------->
        <script src="./js/jquery-3.5.1.slim.min.js"></script>
        <script src="./js/popper.min.js"></script>
        <script src="./js/bootstrap.min.js"></script>
    </body>

    </html>