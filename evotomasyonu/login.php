<?php include "sayfalar/baglan.php";   ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
    <div class="container">
        <div class="d-flex justify-content-center h-100">
            <div class="cardlogin">
                <div class="card-header">
                    <h3>Giriş Yap</h3>

                </div>
                <div class="card-body">

                    <form action="" method="POST">
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="text" name="kullaniciadi" class="form-control" placeholder="Kullanıcı Adı" required="">

                        </div>
                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                            <input type="password" name="sifre" class="form-control" placeholder="Şifre" required="">
                        </div>




                        <div class="form-group">
                            <input type="submit" value="Giriş Yap" class="btn float-right login_btn btn-info">
                        </div>
                    </form>
                </div>

                <?php
                session_start();
                if ($_POST) {

                    $kullanici_adi = $_POST['kullaniciadi'];
                    $kullanici_sifre = $_POST['sifre'];
                    $giris = $db->query("SELECT * FROM kullanici where kullanici_adi='$kullanici_adi' and kullanici_sifre='$kullanici_sifre'");
                    if ($giris->rowCount() > 0) {
                        while ($row = $giris->fetch(PDO::FETCH_ASSOC)) {
                            echo '<span style="color:#17a2b8;text-align:center;">Giriş Başarılı.</br>Uygulamaya Yönlendiriliyorsunuz...</span>';
                            header("Refresh: 2; url=sayfalar/evotomasyonu.php");
                        
                          
                        }
                    } else {
                        echo '<span style="color:#ff0000;text-align:center;">Kullanıcı Adı Veya Şifre Yanlış.</span>';
                    }
                }
                ?>


            </div>

        </div>

    </div>



</body>

</html>