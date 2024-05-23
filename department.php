<?php
// ນຳໄຟລ໌ຂອງ login-check.php  ຖ້າເຈົ້າເຂົ້າໄຟລ໌ index.php ໄດ້ຕ້ອງ login ກອນ
include_once 'login_check.php';
//ຫຼື ໜ້າ profiel.php

include_once 'function/function.php';

$dno = $dept_name = $location = $incentive = $message = " ";
if (isset($_POST['btnAdd'])) {
    $dno = data_input($_POST['dno']);
    $dept_name = data_input($_POST['dept_name']);
    $location = data_input($_POST['location']);
    $incentive = str_replace(",", "", data_input($_POST['incentive']));

    //ກວດສອບວ່າລະຫັດມີແລ້ວ ຫຼື ບໍ
    $sql = "SELECT * FROM dept WHERE dno = '$dno'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $error_dno = "ລະຫັດຖືກນຳໃຊ້ແລ້ວ";
    } else {
        $sql = "INSERT INTO dept VALUES ('$dno', '$dept_name', '$location', '$incentive')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $dno = $dept_name = $location = $incentive = "";
            $message = '<script>swal("ສຳເລັດ", "ເພີ່ມຂໍ້ມູນລົງຖານຂໍ້ມູນສຳເລັດ", "success", {button: "ຕົກລົງ"}); </script>';
        } else {
            echo mysqli_error($conn);
            //ທົດສອບ
        }
    }
    //ຂຽນຟັງຊັນປຸ່ມແກ້ໄຂ
} elseif (@$_GET['action'] == 'edit') {
    $dno = $_GET['dno'];
    $sql = "SELECT * FROM dept WHERE dno = '$dno'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $dno = $row['dno'];
    $dept_name = $row['name'];
    $location = $row['loc'];
    $incentive = $row['incentive'];
    //ຍົກເວັ້ນຕົວ dno ບໍ່ສາມາດແກ້ໄຂໄດ້ 
} elseif (isset($_POST['btnEdit'])) {
    $dno = data_input($_POST['dno']);
    $dept_name = data_input($_POST['dept_name']);
    $location = data_input($_POST['location']);
    $incentive = str_replace(",", "", data_input($_POST['incentive']));

    $sql = "UPDATE dept SET name = '$dept_name', loc='$location', incentive='$incentive' WHERE dno = '$dno'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $dno = $dept_name = $location = $incentive = "";
        $message = '<script>swal("ສຳເລັດ", "ປັບປູງຂໍ້ມູນສຳເລັດ", "success", {button: "ຕົກລົງ"}); </script>';
    } else {
        echo mysqli_error($conn);
        //ທົດສອບ
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ຈັດການຂໍ້ມູນພະແນກ</title>
    <link rel="icon" href="image/hr_logo.jpg">
    <link rel="stylesheet" href="css/dataTables.bootstrap5.min.css">
    <!--  -->
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="./fontawesome/css/all.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <!--  -->
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap5.min.js"></script>
    <script src="js/jquery.priceformat.min.js"></script>
    <script src="js/sweetalert.min.js"></script>
</head>

<body>
    <!-- ນຳໄຟລ໌ຂອງ menu.php ເຂົ້າມາ -->
    <?php include_once 'menu.php' ?>
    <?= @$message ?>


    <div class="container mt-3">
        <div class="row">
            <div class="col-md-4 mt-3">
                <fieldset class="border  p-2 px-4 pb-4 rounded-3" style="border:gray;">
                    <legend class="float-none w-auto p-2 h6 fw-bold">ຈັດການຂໍ້ມູນພະແນກ</legend>
                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                        <div class="mb-3 ">
                            <label for="dno" class="form-label">ປ້ອນລະຫັດ:</label>
                            <input type="text" class="form-control" id="dno" placeholder="ປ້ອນລະຫັດ:" name="dno" require value="<?= @$dno ?>" maxlength="6" <?php if (@$_GET['action'] == 'edit') echo 'readonly' ?>>
                            <!-- ຕອ້ງເບີ່ງວ່າຢູ່ຖານຂໍ້ມູນເຮົາຕ້ອງໄວ້ສຳໄດ້ໃສ່ເກີນບໍ່ໄດ້ -->
                            <div class="form-control-feedback">
                                <div class="text-danger">
                                    <!-- ສະແດງແຈ້ງເຕື່ອນ -->
                                    <?= @$error_dno ?>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 ">
                            <label for="dept_name" class="form-label">ຊື່ພະແນກ:</label>
                            <input type="text" class="form-control" id="dept_name" placeholder="ປ້ອນພະແນກ:" name="dept_name" require value="<?= @$dept_name ?>">
                        </div>
                        <div class="mb-3 ">
                            <label for="location" class="form-label">ທີ່ຢູ່:</label>
                            <input type="text" class="form-control" id="location" placeholder="ປ້ອນທີ່ຢູ່:" name="location" require value="<?= @$location ?>">
                        </div>
                        <div class="mb-3 ">
                            <label for="incentive" class="form-label">ເງິນອູດໜູນ:</label>
                            <input type="text" class="form-control" id="incentive" placeholder="ປ້ອນເງິນອູດໜູນ:" name="incentive" require value="<?= @$incentive ?>">
                        </div>
                        <?php
                        if (@$_GET['action'] == 'edit') {
                            echo  '<button type="submit" name="btnEdit" class="btn btn-info" style="width: 110px; border-radius: 20px"><i class="fas fa-edit">&nbsp;&nbsp; ແກ້ໄຂ</i></button>';
                        } else {
                            echo  '<button type="submit" name="btnAdd" class="btn btn-primary" style="width: 110px; border-radius: 20px"><i class="fas fa-plus-circle">&nbsp;&nbsp; ເພີ່ມ</i></button>';
                        }
                        ?>

                        <button type="submit" name="btnReset" class="btn btn-warning" style="width: 110px; border-radius: 20px"><i class="fas fa-sync">&nbsp;&nbsp;
                                ຍົກເລີກ</i></button>
                    </form>

                </fieldset>
            </div>
            <div class="col-md-8 mt-3">
                <table id="example" class="table table-hover table-bordered" style="width:100%">
                    <thead class="bg-secondary text-center text-white">
                        <tr>
                            <th>ລະຫັດ</th>
                            <th>ພະແນກ</th>
                            <th>ສະຖານທີ</th>
                            <th>ເງີນອູດໜູນ</th>
                            <th>ອອບຊັ້ນ</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM dept";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <tr>
                                <td><?= $row['dno'] ?></td>
                                <td><?= $row['name'] ?></td>
                                <td><?= $row['loc'] ?></td>
                                <td><?= number_format($row['incentive']) ?></td>
                                <td class="text-center" style="width: 80px;">
                                    <a href="department.php?action=edit&dno=<?= $row['dno'] ?>" data-bs-toggle="tooltip" data-bs-placement="bottom" title="ແກ້ໄຂ"><i class="fas fa-edit text-success"></i></a>
                                    <a href="#" onclick="deletedata(<?php echo '\'' . $row['dno'] . '\'' ?>)" data-bs-toggle="tooltip" data-bs-placement="left" title="ລືບ"><i class="fas fa-trash-alt text-danger"></i></a>
                                    <!-- ແລ້ວມາຂຽນ javaScript -->
                                </td>

                            </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
        // ເອົາມາຈາກ id=incentive
        $('#incentive').priceFormat({
            prefix: ' ',
            thousandsSeparator: ',',
            centsLimit: 0
        });
    });
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)

    });
    //ບໍ່ໃຫ້ມັນກົດສັບມິດຄືນ
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    //ສ້າງຟັງຊັນລືບຂໍ້ມູນ
    function deletedata(id) { //ລອງທົດທອບວ່າມັນສົ່ງຂໍ້ມູນຫຍັງມາບໍ່
        swal({
                title: "ເຈົ້າຕ້ອງການລື່ມແທ້ ຫຼື ບໍ?",
                text: "ຂໍ້ມູນລະຫັດ " + id + ", ເມືອລືບແລ້ວຈະບໍ່ສາມາດກູ້ຂໍ້ມຸນໄດ້!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                //ເພີ່ມປຸ່ມເຈົ້າໄປ
                buttons: ['ຍົກເລີກ', 'ຕົກລົງ']
            })
            .then((willDelete) => {
                if (willDelete) {
                    //ເພີ່ມໂຄ້ດ
                    $.ajax({
                        url: "dept-delete.php",
                        method: "post",
                        data: {
                            dno: id
                        },
                        success: function(data) {
                            swal("ສຳເລັດ", "ຂໍ້ມູນຖືກລືບອອກຈາກຖານຂໍ້ມູນແລ້ວ", "success", {
                                button: "ຕົກລົງ",
                            });
                            //ໃຫ້ໂປຼແກຣມ set timeout
                            setTimeout(function() {
                                location.reload();
                            }, 2000); //2000=2ວິນາທີ
                        }
                    });

                } else {
                    swal("ຂໍ້ມູນຂອງຖານຍັງປອດໄພ", {
                        button: "ຕົກລົງ",
                    });
                }
            });
    }
</script>