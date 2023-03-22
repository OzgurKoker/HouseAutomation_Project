<?php

include 'baglan.php';
$isikdurum = $db->query("SELECT * FROM statusled WHERE id=1 ")->fetch(PDO::FETCH_ASSOC);
$penceredurum = $db->query("SELECT * FROM statusled WHERE id=2 ")->fetch(PDO::FETCH_ASSOC);
$vanadurum = $db->query("SELECT * FROM statusled WHERE id=3 ")->fetch(PDO::FETCH_ASSOC);
$kapidurum = $db->query("SELECT * FROM statusled WHERE id=4 ")->fetch(PDO::FETCH_ASSOC);
$kapisw = $db->query("SELECT * FROM statusled WHERE id=5 ")->fetch(PDO::FETCH_ASSOC);
$isik_log2 = $db->query("SELECT * FROM log_isik ORDER BY id DESC ")->fetch(PDO::FETCH_ASSOC);
$vana_log = $db->query("SELECT * FROM log_vana ORDER BY id DESC ")->fetch(PDO::FETCH_ASSOC);
$kapi_log = $db->query("SELECT * FROM log_kapi ORDER BY id DESC ")->fetch(PDO::FETCH_ASSOC);

?>
<html>

<head>
  
 
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="icon" href="../images/home.png" type="image/x-icon" />
    <title>Ev Otomasyonu</title>
</head>

<body>

    <nav id="navbar">
        <a href="isik_log.php"> <button type="button" class="btn btn-warning">LOGLAR</button></a>
        <a href="../login.php"> <button type="button" class="btn btn-danger">ÇIKIŞ YAP</button></a>
    </nav>
    <div class="container-fluid">
        <div class="card-group">
            <div class="card1 text-white  mb-3" style="max-width: 20rem;">
                <div class="card-header">
                    <h5 class="card-title">Işık</h5>
                </div>
                <div class="card-body">
                    <img src="../images/ampul.png" alt="" style="max-width: 300px;">
                    <br><br>
                    <h3>

                        <?php
                        if ($isikdurum['Stat'] == 1) {

                            echo   'Açık';
                        } else if ($isikdurum['Stat'] == 0) {
                            echo "Kapalı";
                        }




                        ?>

                    </h3>


                    <form action="lambaupdate.php" method="POST">

                        <button type="submit" class="btn left btn-success" name="ON">Aç</button>
                        <button type="submit" class="btn left btn-danger" name="OFF">Kapat</button>

                    </form>

                    <p>En Son <?php echo  $isik_log2['log_acik'] ?> Tarihinde Açıldı</p>
                    <p>En Son <?php echo $isik_log2['log_kapali'] ?> Tarihinde Kapatıldı</p>
                </div>
            </div>
            <div class="card2 text-white  mb-3" style="max-width: 20rem;">
                <div class="card-header">
                    <h5 class="card-title">Kapı</h5>
                </div>
                <div class="card-body">
                    
                    <br><br>
                    <h3>Kapı Kilidi:
                        <?php
                        if ($kapidurum['Stat'] == 1) {
                          
                            echo   'Açık';
                        } else if ($kapidurum['Stat'] == 0) {
                            echo "Kapalı";
                        }




                        ?>

                    </h3>

                    <h3>Kapı Durumu:
                        <?php

                        if ($kapisw['Stat'] == 1) {

                            echo   'Açık';
                        } else if ($kapisw['Stat'] == 0) {
                            echo "Kapalı";
                        }




                        ?>
                        <h3>Alarm:
                            <?php

                            if ($kapisw['Stat'] == 1 && $kapidurum['Stat'] == 0) {

                                echo '<span style="color:#f54242;text-align:center;">Çalıyor !!!</span>';
                            } else {
                                echo '<span style="color:#AFA;text-align:center;">Çalmıyor</span>';
                            }




                            ?>




                        </h3>
                        <form action="kapiupdate.php" method="POST">

                            <button type="submit" class="btn left btn-success" name="ON" style="height:50px; width:100px">Kilidi Aç</button>
                            <button type="submit" class="btn left btn-danger" name="OFF" style="height:50px; width:110px">Kilidi Kapat</button>

                        </form>

                        <p>En Son <?php echo  $kapi_log['log_acik'] ?> Tarihinde Açıldı</p>
                        <p>En Son <?php echo $kapi_log['log_kapali'] ?> Tarihinde Kapatıldı</p>
                </div>
            </div>
            <div class="card3 text-white  mb-3" style="max-width: 20rem;">
                <div class="card-header">
                    <h5 class="card-title">Pencere</h5>
                </div>
                <div class="card-body">
                    <img src="../images/pencere.png" alt="" style="max-width: 300px;">
                    <br><br>
                    <h3>
                        <?php

                        if ($penceredurum['Stat'] == 1) {

                            echo   'Açık';
                        } else if ($penceredurum['Stat'] == 0) {
                            echo "Kapalı";
                        }




                        ?>

                    </h3>


                </div>
            </div>
            <div class="card4 text-white  mb-3" style="max-width: 20rem;">
                <div class="card-header">
                    <h5 class="card-title">Vana</h5>
                </div>
                <div class="card-body">
                    <img src="../images/vana.png" alt="" style="max-width: 280px;">
                    <br><br>
                    <h3>
                        <?php
                        if ($vanadurum['Stat'] == 1) {

                            echo   'Açık';
                        } else if ($vanadurum['Stat'] == 0) {
                            echo "Kapalı";
                        }




                        ?>


                    </h3>
                    <form action="vanaupdate.php" method="POST">

                        <button type="submit" class="btn left btn-success" name="ON">Aç</button>
                        <button type="submit" class="btn left btn-danger" name="OFF">Kapat</button>

                    </form>
                    <p>En Son <?php echo  $vana_log['log_acik'] ?> Tarihinde Açıldı</p>
                    <p>En Son <?php echo $vana_log['log_kapali'] ?> Tarihinde Kapatıldı</p>
                </div>
            </div>
        </div>
    </div>









</body>

</html