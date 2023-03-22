

<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/log.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="../images/home.png" type="image/x-icon" />
    <title>Ev Otomasyonu</title>

</head>

<body>
    <nav>
        <a href="evotomasyonu.php"><button type="button" class="btn btn-warning">Geri Dön</button></a>
        <a href="isik_log.php"><button id="buton1" type="button" class="btn btn-warning">Işık</button></a>
        <a href="kapi_log.php"><button id="buton2" type="button" class="btn btn-warning">Kapı</button></a>
        <a href="vana_log.php"><button id="buton4" type="button" class="btn btn-warning">Vana</button></a>
    </nav>








    <div class="container-fluid">
        <div class="container1">
            <form  action="" method="POST">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tarihten</label>
                            <input type="datetime-local" name="log_acik" value="<?php if (isset($_GET['log_acik'])) {
                                                                                    echo $_GET['log_acik'];
                                                                                } ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Tarihe</label>
                            <input type="datetime-local" name="log_kapali" value="<?php if (isset($_GET['log_kapali'])) {
                                                                                        echo $_GET['log_kapali'];
                                                                                    } ?>" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <br>
                            <button type="submit" class="btn btn-success">Filtrele</button>
                            
                        </div>
                    </div>
                </div>
            </form>
            <h3>KAPI</h3>
            <table id="tablo" class="table">
                <thead>

                    <th>Açıldı</th>
                    <th>Kapandı</th>

                </thead>
                <tbody>



                    <?php
                    $con = mysqli_connect("localhost", "root", "", "dbstatusled");

                    if ($_POST) {
                        $log_acik = $_POST['log_acik'];
                        $log_kapali = $_POST['log_kapali'];

                        $query = "SELECT * FROM log_kapi WHERE log_acik BETWEEN '$log_acik' AND '$log_kapali' ";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                    ?>
                                <tr>

                                    <td><?= $row['log_acik']; ?></td>
                                    <td><?= $row['log_kapali']; ?></td>
                                </tr>
                            <?php
                            }
                        } else {
                            echo "Veri Bulunamadı !!";
                        }
                    } else {
                        $query = "SELECT * FROM log_kapi ";
                        $query_run = mysqli_query($con, $query);
                        if (mysqli_num_rows($query_run) > 0) {
                            foreach ($query_run as $row) {
                            ?>
                                <tr>

                                    <td><?= $row['log_acik']; ?></td>
                                    <td><?= $row['log_kapali']; ?></td>
                                </tr>
                    <?php
                            }
                        }
                    }

                    ?>

                </tbody>

            </table>
        </div>

    </div>




</body>

</html