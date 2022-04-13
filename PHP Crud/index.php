<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Crud</title>
    <link rel="stylesheet" href="./bootstrap-4.2.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="./bootstrap-4.2.1-dist/js/jquery-3.3.1.js">
</head>
<body>

    <?php require_once 'process.php'; ?>






<?php

    if(isset($_SESSION['message'])): ?>

    <div class="alert alert-<?=$_SESSION['msg_type']?>">

    <?php 
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    ?>
</div>

<?php endif; ?>



    <div class="container">

    <?php
    $mysqli = new mysqli('localhost', 'root', 'Flabagasted', 'crud')
    or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM data") or die($mysqli->error);
?>



    <div class="row justify-content-center">
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Location</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>

    <?php
        while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['location']; ?></td>
                <td>
                    <a href="index.php?edit=<?php echo $row['id']; ?>"
                    class="btn btn-info">Edit</a>
                    <a href="process.php?delete=<?php echo $row['id']; ?>"
                    class="btn btn-danger">Delete 🗑</a>
                </td>
            </tr> 

        <?php endwhile; ?>

        </table>
    </div>





<?php
        // pre_r($result->fetch_assoc());
    function pre_r($array){
        echo '<pre>';
        print_r($array);
        echo '</pre>';
    }
 
    ?>

    <div class="row justify-content-center">
    <form action="process.php" method="POST">


    <input type="hidden" name="id" value="<?php echo $id; ?>">



        <div class="form-group">
        <label for="">Name</label>
        <input type="text"  class="form-control"  name="name"
        value="<?php echo $name; ?>" placeholder="Enter Your Name">
        </div>

        <div class="form-group">
        <label for="">Location</label>
        <input type="text" name="location" class="form-control" 
         value="<?php echo $location; ?>"
        placeholder="Enter Your Location">
        </div>

        <div class="form-group">

            <?php
            if($update == true): ?>
        <button type="submit" class="bnr btn-info" name="update">Update</button>

                <?php else: ?>
        <button type="submit" class="bnr btn-primary" name="save">Save</button>
                    <?php endif; ?>
    </div>
    </form>
    </div>
</div>
</body>
</html>