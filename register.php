<?php
session_start();
include_once "./conect_db.php";
include_once './function/function.php';

if (isset($_POST['register'])) {
    $name = data_input($_POST['name']);
    $phone = data_input($_POST['phone']);
    $username = data_input($_POST['username']);
    $password = data_input($_POST['password']);
    $con_password = data_input($_POST['con_password']);


    $mysl = "SELECT*FROM user WHERE username = '$username'";

    $result = mysqli_query($conn, $mysl);
    if (mysqli_num_rows($result) > 0) {
        $error_username = "ຊື່ບັນຊີຜູ້ນີ້ມີຢູ່ໃນລະບົບແລ້ວ";
    }

    if ($password !== $con_password) {
        $error_password = "ລະຫັດຜ່ານບໍ່ຄືກັນ";
    }

    if (empty($error_username) && empty($error_password)) {
        $password = md5($password);
        $mysl = "INSERT INTO user  VALUES ('', '$name', '$phone', '$username', '$password')";
        if ($mysl) {
            header('location: ./index.php');
        }
        $result = mysqli_query($conn, $mysl);
        if ($result) {
            $_SESSION['username'];
            $_SESSION['password'];
        } else {
            echo mysqli_error($conn);
        }
    }
}
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
    <title>ລະບົບຈັດລົງທະບຽນ</title>
</head>

<body>
    <?php include_once 'menu.php' ?>

    <section class="vh-100">
        <div class="container h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <fieldset class="border-success p-2 pb-4" style="border-radius: 8px;">
                        <div class="card text-black" style="border-radius: 8px;">
                            <legend class="flaot-none m-4" style="color: grey;">ຟອມປ້ອນຂໍ້ມູນລົງທະບຽນ</legend>
                            <div class="card-body p-md-5">
                                <div class="row justify-content-center">
                                    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                        <form class="mx-1 mx-md-4"
                                            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                                            method="POST">
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-user fa-lg me-3 fa-fw" style="color: gold;"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="text" id="form3Example1c" class="form-control"
                                                        value="<?= @$name ?>" name="name" required
                                                        oninvalid="this.setCustomValidity('ກາລຸນາປ້ອນຊື່ ແລະ ນາມສະກຸນ ');" />
                                                    <label class="form-label" for="form3Example1c"
                                                        style="color: grey;">ຊື່ ແລະ
                                                        ນາມສະກຸນ</label>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-envelope fa-lg me-3 fa-fw" style="color: gold;"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="tel" id="form3Example3c" class="form-control"
                                                        value="<?= @$phone ?>" name="phone" required
                                                        oninvalid="this.setCustomValidity('ກາລຸນາປ້ອນເບີໂທຂອງທ່ານ')" />
                                                    <label class="form-label" for="form3Example3c"
                                                        style="color: grey;">ເບີໂທ</label>
                                                </div>
                                            </div>
                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-user fa-lg me-3 fa-fw" style="color: gold;"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="text" id="form3Example1c" class="form-control"
                                                        value="<?= @$username ?>" name="username" required
                                                        oninvalid="this.setCustomValidity('ກາລຸນາປ້ອນຊື່ບັນຊີ')" />
                                                    <label class="form-label" for="form3Example1c"
                                                        style="color: grey;">ຊື່ເຂົ້າບັນຊີ</label>
                                                    <div class="form-control-feedback">
                                                        <div class="text-danger align-middle">
                                                            <!-- ເມື່ອມີການຊໍ້າກັນ ແຈ້ງ alert -->

                                                            <?=
                                                            @$error_username;
                                                            ?>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-lock fa-lg me-3 fa-fw" style="color: gold;"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="password" id="form3Example4c" class="form-control"
                                                        value="<?= @$password ?>" name="password" required
                                                        oninvalid="this.setCustomValidity('ກາລຸນາປ້ອນລະຫັດຜ່ານ')" />
                                                    <label class="form-label" for="form3Example4c"
                                                        style="color: grey;">ລະຫັດຜ່ານ</label>
                                                    <div class="form-control-feedback">
                                                        <div class="text-danger align-middle">
                                                            <!-- ເມື່ອມີການຊໍ້າກັນ ແຈ້ງ alert -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="d-flex flex-row align-items-center mb-4">
                                                <i class="fas fa-key fa-lg me-3 fa-fw" style="color: gold;"></i>
                                                <div class="form-outline flex-fill mb-0">
                                                    <input type="password" id="form3Example4cd" class="form-control"
                                                        value="<?= @$con_passeord ?>" name="con_password"
                                                        oninvalid="this.setCustomValidity('ກາລຸນາປ້ອນການຢືນຢັນລະຫັດຜ່ານ')" />
                                                    <label class="form-label" for="form3Example4cd"
                                                        style="color: grey;">ຢືນຢັນລະຫັດຜ່ານ</label>
                                                    <div class="form-control-feedback">
                                                        <div class="text-danger align-middle">
                                                            <!-- ເມື່ອມີການຊໍ້າກັນ ແຈ້ງ alert -->
                                                            <?= @$error_password; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>



                                            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-6">
                                                <button type="submit" class="btn btn-primary btn-lg mx-2"
                                                    name="register"><i class="fas fa-plus-circle"></i>ລົງທະບຽນ</button>
                                                <a href="./register.php" class="nav-link"><button type="reset"
                                                        class="btn btn-warning btn-lg"><i
                                                            class="fas fa-sync text-danger"></i>ຍົກເລິກ</button></a>
                                            </div>

                                            <span>ມີບັນຊີຢູ່ໃນລະບົບແລ້ວ<a href="./login.php" role="button">
                                                    ລົງຊື່ເຂົ້າໃຊ້?</a><span>
                                        </form>

                                    </div>
                                    <div
                                        class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                        <img src="./images/gg.gif" class="img-fluid" alt="Sample image">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </section>


    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
</body>

</html>