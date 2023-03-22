<html>
<?php
include 'baglan.php';
?>
<head>
    <link rel="stylesheet" type="text/css" href="../css/log.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="../images/home.png" type="image/x-icon" />
    <title>Ev Otomasyonu</title>
    <meta http-equiv="refresh" content="10">
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
            <form action="" method="POST">
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
            <h3>VANA</h3>
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

                        $query = "SELECT * FROM log_vana WHERE log_acik BETWEEN '$log_acik' AND '$log_kapali' ";
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
                        $query = "SELECT * FROM log_vana ";
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

    <div class="container2">
        <h3>Vananın Açılacağı Tarihi Seçiniz:</h3>
        <form action="" method="POST">
            <div class="form-group">
                <input type="datetime-local" id="saat" name="saat">
                <button class="btn btn-success" type="submit" name="gonder" id="gonder" value="Submit">Tarih Seç</button>
                <button type="submit" class="btn left btn-danger" name="gonder2">Vanayı Kapat</button>
            </div>

        </form>

        <?php
        function getReturnTime($date)
        {
            date_default_timezone_set('Europe/Istanbul');
            $create_time = strtotime($date);
            $current_time = time();
            $dtCreate = DateTime::createFromFormat('U', $create_time);
            $dtCurrent = DateTime::createFromFormat('U', $current_time);
            $diff = $dtCurrent->diff($dtCreate);
            $interval = $diff->format("%y yıl %m ay %d gün %h saat %i dakika %s saniye sonra açılacak");
            $interval = preg_replace('/(^0| 0) (yıl|ay|gün|saat|dakika|saniye)/', '', $interval);
            echo $interval;
        }


        $sontarih = $db->query("SELECT * FROM vana_zaman WHERE id=1")->fetch(PDO::FETCH_ASSOC);

        date_default_timezone_set('Europe/Istanbul');
        $bitistarih = $sontarih['tarih'];

        $baslangictarih = date('d.m.Y H:i:s');
        $t = strtotime($bitistarih) - strtotime($baslangictarih);

        if ($t < 1) {


            $sonuc5 = $db->exec("UPDATE vana_zaman SET tarih = '2033-06-01T08:30' WHERE id = 1");
            echo "<br> Vana Açıldı";
            $sonuc = $db->exec("UPDATE statusled SET Stat = '1' WHERE id = 3");
            date_default_timezone_set('Europe/Istanbul');

            $tarihlog = date('Y.m.d H:i:s');
         
            $log1 = $db->query("INSERT INTO log_vana(log_acik) VALUES('$tarihlog')");
        } else {
            echo "<br>";
            getReturnTime($sontarih['tarih']);
        }

        ?>



        <?php
        if (isset($_POST['gonder'])) {
            $saat = $_POST['saat'];
            $sonuc2 = $db->exec("UPDATE vana_zaman SET tarih = '$saat' WHERE id = 1");
            header("Refresh: 0;");
        }
        ?>
        <?php
        if (isset($_POST['gonder2'])) {
            $sonuc3 = $db->exec("UPDATE statusled SET Stat = '0' WHERE id = 3");
            date_default_timezone_set('Europe/Istanbul');
            $tarihlog = date('Y.m.d H:i:s');
            $log2 = $db->query("UPDATE log_vana SET log_kapali='$tarihlog' WHERE log_kapali=0");
            header("Refresh: 0;");
        }
        ?>
    </div>







</body>

</html