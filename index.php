<?php
require_once "config/database.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Aplikasi CRUD</title>


  <link rel="shortcut icon" href="assets/img/favicon.png">
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/datepicker.min.css" rel="stylesheet">


  <link href="assets/css/style.css" rel="stylesheet">

  <!-- Fungsi untuk membatasi karakter yang diinputkan -->
  <script language="javascript">
    function getkey(e) {
      if (window.event)
        return window.event.keyCode;
      else if (e)
        return e.which;
      else
        return null;
    }

    function goodchars(e, goods, field) {
      var key, keychar;
      key = getkey(e);
      if (key == null) return true;

      keychar = String.fromCharCode(key);
      keychar = keychar.toLowerCase();
      goods = goods.toLowerCase();

      // Cek kunci char
      if (goods.indexOf(keychar) != -1)
        return true;

      // Kontrol dari kunci
      if (key == null || key == 0 || key == 8 || key == 9 || key == 27)
        return true;

      if (key == 13) {
        var i;
        for (i = 0; i < field.form.elements.length; i++)
          if (field == field.form.elements[i])
            break;
        i = (i + 1) % field.form.elements.length;
        field.form.elements[i].focus();
        return false;
      };
      // else kembali jika salah
      return false;
    }
  </script>
</head>

<body>
  <nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="index.php">
          <i class="glyphicon glyphicon-check"></i>
          Pemograman Aplikasi Berbasis Web | CRUD Mahasiswa | Manajemen Informatika SV IPB 2020
        </a>
      </div>
    </div>
  </nav>

  <div class="container-fluid">
    <?php
    if (empty($_GET["page"])) {
      include "tampil-data.php";
    } elseif ($_GET['page'] == 'tambah') {
      include "form-tambah.php";
    } elseif ($_GET['page'] == 'ubah') {
      include "form-ubah.php";
    }
    ?>
  </div>

  <footer class="footer">
    <div class="container-fluid">
      <p class="text-muted pull-left">&copy; 2020 | Pemograman Aplikasi Berbasis Web</p>
      <p class="text-muted pull-right ">Dibuat oleh <a href="http://www.instagram.com/galihwpriambudi" target="_blank">GALIH WISNU PRIAMBUDI | J3C118082</a></p>
    </div>
  </footer>

  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/bootstrap-datepicker.min.js"></script>
</body>

</html>