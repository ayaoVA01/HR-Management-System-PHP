<?php
include_once 'login_check.php';
include_once 'function/function.php';

if (isset($_POST['btnAdd'])) {
    $empno = data_input($_POST['empno']);
    $empname = data_input($_POST['empname']);
    $gender = $_POST['gender'];
    $date_birth = $_POST['date_birth'];
    $address = nl2br(trim(stripslashes($_POST['address']))); //ຖ້າລົງແຖວໃຫ້ມັນໃຊ້ແທັກ <br>

    //ຮັບໄຟລຮູບ
    $file_image = $_FILES['file_image']['name'];
    $file_tmp = $_FILES['file_image']['tmp_name'];

    //ພະແນກ
    $department = $_POST['department'];
    $salary = $_POST['salary'];
    $incentive = str_replace(",", "", $_POST['incentive']);
    $language = implode(" ,", $_POST['language']); //ໂຕພາສານີ້ເນາະເຮົາເກັບເປັນແບບຂອງ array ເຮົາຈະເອົາມາລ່ວມກັນເລີຍ
    // ຫຼັງຈາກນັ້ນໃຫ້ທົດລອງເບີ່ງວ່າບໍ່ມີໄຟລຄ້າງຟ້ອມຢູ່

    // ຫຼັງຈາກທີ່ຂຽນໂຄ້ດໃຫ້ຂໍ້ມູນມັນຄ້າງຟອມແລ້ວມາຂຽນກວດກວດສອບຕໍ່

    // ກວດສອບວ່າລະຫັດນີ້ມັນຊ້ຳຫຼືບໍ
    $sql = "SELECT empno FROM emp WHERE empno = '$empno'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $message = '<script> swal("ຜິດພາດ", " ລະຫັດພະນັກງານຖືກນຳໃຊ້ແລ້ວ", "error", {button: "ຕົງລົງ",}); </script>';
    } else {
        // ໃນກໍລະນີລະຫຍັງບໍ່ທັນຖືກນຳໃຊ້ເຮົາຈະປຽນຊື່ໄຟລຮຸບ
        $file_image = round(round(microtime(TRUE))) . $file_image;
        move_uploaded_file($file_tmp, "images/" . $file_image);
        $sql = "INSERT INTO emp VALUES('$empno', '$empname', '$gender', '$date_birth', '$incentive', '$language', '$file_image','$address', '$salary', '$department')";

        $result = mysqli_query($conn, $sql);
        // ຖ້າຄິວລີຜ່ານ
        if ($result) {
            $message = '<script> swal("ສຳເລັດ", "ຂໍ້ມູນຖືກບັກທືກລົງໃນຖານຂໍ້ມູນສຳເລັດ ","success", {button: "ຕົກລົງ",}); </script>';
            $empno = $empname = $gender = $date_birth = $address = $file_image = $department = $salary = $incenitive = $language = "";
        } else {
            echo mysqli_error($conn);
            // <!-- ທົດສອບ -->
        }
    }
    if ($_FILES['file_image']['error'] !== UPLOAD_ERR_OK) {
        die('File upload failed with error code: ' . $_FILES['file_image']['error']);
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
    <title>ລະບົບຈັດການຂໍ້ມູນພະນັກງານ</title>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="js/jquery.priceformat.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
    <script src="./bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    #img-upload {
        width: 150px;
        height: 180px;
        margin-bottom: 20px;
    }
    </style>
</head>

<body>
    <?php include_once 'menu.php' ?>
    <?= @$message ?>

    <div class="container-fruid mt-3">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <span class="d-flex justify-content-end">
                    <a href="emp-manage.php" class="btn btn-secondary"><i
                            class="fas fa-address-card"></i>&nbsp;ສະແດງຂໍ້ມູນ</a>
                </span>
                <div class="card border-primary">
                    <div class="card-header bg-info text-white h5">
                        ຟອມປ້ອນຊໍ້ມູນພະນັກງານ
                    </div>
                    <div class="card-body">
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST"
                            enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="md-3">
                                                <label for="empno" class="form-label">ລະຫັດພະນັກງານ</label>
                                                <input type="text" class="form-control" id="empno" name="empno" require
                                                    value="<?= @$empno ?>">
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="md-3">
                                                <label for="empno" class="form-label">ຊື່ພະນັກງານ</label>
                                                <input type="text" class="form-control" id="empno" name="empname"
                                                    require value="<?= @$empname ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">

                                            <p>ເພດ</p>
                                            <fieldset class="md-3">
                                                <div class="form-check-inline">

                                                    <input type="radio" name="gender" id="gender1"
                                                        class="form-check-input" value="ຊ"
                                                        <?php if (@$gender == '' || @$gender == 'ຊ') echo "checked"; ?>>


                                                    <label for="gender1" class="check-form-label">ຊາຍ</label>
                                                </div>
                                                <div class="form-check-inline">


                                                    <input type="radio" name="gender" id="gender2"
                                                        class="form-check-input" value="ຍ"
                                                        <?php if (@$gender == 'ຍ') echo "checked"; ?>>
                                                    <label for="gender2" class="check-form-label">ຍີງ</label>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="md-3">
                                                <label for="date_birth" class="form-label"> ວັນເດືອນປີເກິດ</label>
                                                <input type="date" class="form-control" id="date_birth"
                                                    placeholder="../../.." name="date_birth" value="<?= @$date_birth ?>"
                                                    require>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="md-3">
                                                <label for="adress" class="form-label">ທີ່ຢຸ່</label>
                                                <textarea name="address" id="" cols="5" rows="5"
                                                    class="form-control"><?= strip_tags(@$address) ?></textarea>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div style="text-align: center;">
                                                <img id='img-upload' />
                                                <div id="temp_img">
                                                    <img src="images/profile-icon.webp" alt="ມີຮູບເດີ້" width="150px"
                                                        height="180px" />

                                                </div>

                                                <br>
                                                <div class="input-group">
                                                    <span class="input-group-btn">
                                                        <span class="btn btn-info btn-file">
                                                            ເລືອກຮູບພາບ
                                                            <input type="file" id="imgInp" name="file_image"
                                                                accept="image/*" value="">
                                                        </span>
                                                    </span>
                                                    <input type="text" class="form-control" readonly>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="md-3">
                                                <label for="department" class="form-label">ພະແນກ</label>
                                                <select name="department" id="department" class="form-select"
                                                    require="True">
                                                    <option value="">ເລືອກພະແນກ</option>
                                                    <?php
                                                    $sql = "SELECT dno, name FROM dept";
                                                    $result = mysqli_query($conn, $sql);
                                                    while ($row = mysqli_fetch_assoc($result)) { ?>

                                                    <option value="<?= $row['dno'] ?> "
                                                        <?php if (@$department == $row['dno']) echo "selected" ?>>
                                                        <?= $row['name'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                        </div>

                                    </div>


                                </div>
                                <br>
                                <div class="col-md-4 ">
                                    <div class="md-3">
                                        <label for="salary" class="form-label">ຂັ້ນເງີນເດືອນ</label>
                                        <select name="salary" id="salary" class="form-select" require="TRUE">
                                            <option value="">ຂັ້້ນເງີນເດືອນ</option>
                                            <?php
                                            $sql = "SELECT*FROM salary";
                                            $result = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($result)) { ?>

                                            <option value="<?= $row['grade'] ?> "
                                                <?php if (@$salary == $row['grade']) echo 'selected'; ?>>

                                                <?php
                                                    echo $row['grade'] . "=" . number_format($row['sal']); ?>



                                            </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="incentive" class="form-label">ເງິນອຸດໜູນ</label>
                                        ​<input type="text" class="form-control" id="incentive"
                                            placeholder="ປ້ອນເງີນອຸດໜູນ" name="incentive" value="<?= @$incentive ?>"
                                            min="0">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <fieldset class="form-group">
                                        <p>ພາສາຕ່າງປະເທດ</p>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="language[]"
                                                value="ອັງກິດ"
                                                <?php if (strpos(@$language, "ອັງກິດ") !== FALSE) echo 'checked' ?>>
                                            <label for="" class="form-check-label">ອັງກິດ</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="language[]"
                                                value="ເກົາຫຼີ"
                                                <?php if (strpos(@$language, "ເກົາຫຼີ") !== FALSE) echo 'checked' ?>>
                                            <label for="" class="form-check-label">ເກົາຫຼີ</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="language[]"
                                                value="ຫວຽດ"
                                                <?php if (strpos(@$language, "ຫວຽດ") !== FALSE) echo 'checked' ?>>
                                            <label for="" class="form-check-label">ຫວຽດ</label>
                                        </div>
                                        <div class="form-check-inline">
                                            <input type="checkbox" class="form-check-input" name="language[]"
                                                value="ອື່ນໆ"
                                                <?php if (strpos(@$language, "ອື່ນໆ") !== FALSE) echo 'checked' ?>>
                                            <label for="" class="form-check-label">ອື່ນໆ</label>
                                        </div>

                                    </fieldset>
                                </div>
                                <dov class="col-md-12 text-center">
                                    <input type="submit" name="btnAdd" id="btnAdd" class="btn btn-primary"
                                        style="width: 100px; border-radius:20px;"> &nbsp;&nbsp;&nbsp;
                                    <input type="reset" value="ຍົກເລິກ" id="btnAdd" class="btn btn-warning"
                                        style="width: 100px; border-radius:20px;"> &nbsp;&nbsp;&nbsp;
                                    <button onclick="window.location.reload(true)" class="btn btn-success"
                                        style="width: 100px; border-radius: 20px;">ໂຫຼດໄຫມ່</button>

                                </dov>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>


</body>

</html>

<script>
$(document).ready(function() {
    // ເລືອຮູບ
    $('#img-upload').hide();
    $(document).on('change', '.btn-file :file', function() {
        var input = $(this),
            label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
        input.trigger('fileselect', [label]);
        $('#temp_img').hide(); /* ໃຫ້ເຊືອງເມືອເລືອກຮູບ*/
        $('#img-upload').show();

    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        var input = $(this).parents('.input-group').find(':text'),
            log = label;

        if (input.length) {
            input.val(log);
        } else {
            if (log)
                alert(log);

        }
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#img-upload').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $('#imgInp').change(function() {
        readURL(this);
    });

    $('#incentive').priceFormat({
        prefix: '',
        thounsandsSeparator: ',',
        centsLinitL: 0
    })


    if (window.history.replace) {
        window.history.replaceState(null, null, window.location.href);
    }

});
</script>