<?php
session_start();
include_once "./conect_db.php";
include_once './function/function.php';

if(isset($_POST['signin'])){
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $mysl = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $mysl);
    if(mysqli_num_rows($result)>0){
        $_SESSION['username'] =$username;
        $_SESSION['password'] = $password;
        header('location: index.php');
    }else{
        $message = '<script> swal("ຜິດພາດ", "ບັນຊີເຂົ້າໃຊ້ ຫຼື ລະຫັດຜ່ານບໍ່ຖືກຕ້ອງ", "error", {button: "ຕົກລົງ"})</script>';
        
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <script src="js/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script></script>
    <title>ເຂົ້າໃຊ້ລະບົບ</title>
    <style>
    .divider:after,
    .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
    }
    </style>
</head>

<body>
    <?php include_once 'menu.php' ?>

    <?= @$message ?>

    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                    <img src="./images/draw2.svg" class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                        <!-- Email input -->
                        <div class=" form-outline mb-4">
                            <input type="text" id="username" class="form-control form-control-lg" name="username"
                                required />
                            <label class="form-label" for="username" style="color: grey;">ຊື່ບັນຊີຜູ້ໃຊ້</label>
                        </div>

                        <!-- Password input -->
                        <div class="form-outline mb-4">
                            <input type="password" id="password" class="form-control form-control-lg" name="password"
                                required />
                            <label class="form-label" for="password" style="color: grey;">ລະຫັດຜ່ານ</label>
                        </div>

                        <div class="d-flex justify-content-around align-items-center mb-4">
                            <!-- Checkbox -->
                            <div class="form-check">

                                <a href="#!">ລືມລະຫັດຜ່ານ?</a>
                            </div>
                            <a href="./register.php" role="button"> ສ້າງບັນຊີໃໝ່?</a>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" class="btn btn-primary btn-lg btn-block"
                            name="signin">ເຂົ້າໃຊ້ລະບົບ</button>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0 text-muted">ຫຼື</p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</html>