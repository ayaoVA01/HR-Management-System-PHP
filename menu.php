<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><i style="color: gold;">HR-Management</i> </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll"
            aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="./index.php"><i class="fas fa-home"
                            style="color: gold;"></i>&nbsp; ໜ້າຫຼັກ</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"><i
                            class="fas fa-database" style="color: gold;"></i> ຈັດການຂໍ້ມູນ</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="emp-manage.php">ຈັດການຂໍ້ມູນພະນັກງານ</a></li>
                        <li><a class="dropdown-item" href="department.php">ຈັດການຂໍ້ມູນພະແນກ</a></li>
                        <li><a class="dropdown-item" href="salary.php">ຈັດການຂໍ້ມູນຂັ້ນເງີນເດືອນ</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="true">
                        <i class="fas fa-file" style="color: gold;"></i>&nbsp; ລາຍງານ
                    </a>
                    <ul class="dropdown-menu ">
                        <li><a class="dropdown-item" href="emp-report.php">ລາຍງານຂໍ້ມູນະນັກງານ</a></li>
                        <li><a class="dropdown-item" href="#">ລາຍງານຂໍ້ມູນພະແນກ</a></li>
                        <li><a class="dropdown-item" href="#">ລາຍງານຂໍ້ມູນຂັ້ນເງີນເດືອນ</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link " aria-current="page" href="#"><i class="fas fa-phone-volume"
                            style="color: gold;"></i>&nbsp; ຕິດຕໍ່ພວກເຮົາ</a>
                </li>

                <li class="nav-item dropdown dropdown-menu-end ">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="fas fa-user" style="color: gold;"></i>&nbsp;ເຂົ້າໃຊ້ລະບົບ
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="./register.php">ລົງທະບຽນ</a></li>
                        <li><a class="dropdown-item" href="./login.php">ເຂົ້າໃຊ້ລະບົບ</a></li>
                        <li><a class="dropdown-item" href="./profile.php">ໂປຣໄຟ</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="./logout.php">ອອກລະບົບ</a></li>
                    </ul>
                </li>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>