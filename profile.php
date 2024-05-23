<?php 

include_once 'login_check.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/hr-icon.jpg" style="width: 30px;">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <title>ໂປຣໄຟ</title>
</head>

<body>
    <?php include_once 'menu.php' ?>

    <?php echo "Hi " . $_SESSION['username']; ?> <script src="./bootstrap/js/bootstrap.bundle.min.js">
    </script>
</body>

</html>