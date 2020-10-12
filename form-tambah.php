<html>

<head>
  <script src="assets/js/js/bootstrap.min.js"></script>
  <script src="assets/js/js/jquery.js"></script>
</head>

<body>

  <script>
    $(function() {
      var button = $('#cekbtn').prop('disabled', true);
      var radios = $('input[type="radio"]');
      var arr = $.map(radios, function(el) {
        return el.name;
      });

      var groups = $.grep(arr, function(v, k) {
        return $.inArray(v, arr) === k;
      }).length;

      radios.on('change', function() {
        button.prop('disabled', radios.filter(':checked').length < groups);
      });
    });
  </script>

  <div class="col-md-12">
    <div class="page-header">
      <h4>
        <i class="glyphicon glyphicon-edit"></i>
        Input Data Mahasiswa
      </h4>
    </div>

    <div class="panel panel-default">
      <div class="panel-body">
        <form class="form-horizontal" method="POST" action="proses-simpan.php" enctype="multipart/form-data" onSubmit="return validate()">
          <div class="form-group">
            <label class="col-sm-2 control-label">NIM</label>
            <div class="col-sm-2">
              <input type="text" class="form-control" name="nim" maxlength="9" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Nama Mahasiswa</label>
            <div class="col-sm-3">
              <input type="text" class="form-control" name="nama" autocomplete="off" required>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Jenis Kelamin</label>
            <div class="col-sm-4">
              <label class="radio-inline">
                <input type="radio" name="jeniskelamin" value="Laki-laki" id="male"> Laki-laki
              </label>

              <label class="radio-inline">
                <input type="radio" name="jeniskelamin" value="Perempuan" id="female"> Perempuan
              </label>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Agama</label>
            <div class="col-sm-3">
              <select class="form-control" name="agama" placeholder="Pilih Agama" required>
                <option value="">Pilih Agama</option>]
                <option value="Islam">Islam</option>
                <option value="Kristen Protestan">Kristen Protestan</option>
                <option value="Kristen Katolik">Kristen Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Buddha">Buddha</option>
                <option value="Konghucu">Konghucu</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Olahraga Favorit</label>
            <div class="col-sm-4">
              <p><input type="checkbox" name="olahraga[]" value="Sepak Bola" /> Sepak Bola</p>
              <p><input type="checkbox" name="olahraga[]" value="Basket" /> Basket</p>
              <p><input type="checkbox" name="olahraga[]" value="Futsal" /> Futsal</p>
              <p><input type="checkbox" name="olahraga[]" value="Badminton" /> Badminton</p>
              <p><input type="checkbox" name="olahraga[]" value="Renang" /> Renang</p>
            </div>
          </div>
          <script language="javascript">
            function validate() {
              var chks = document.getElementsByName('olahraga[]');
              var hasChecked = false;
              for (var i = 0; i < chks.length; i++) {
                if (chks[i].checked) {
                  hasChecked = true;
                  break;
                }
              }

              if (hasChecked == false) {
                alert("Silahkan pilih terlebih dahulu Hobi Anda ya.");
                return false;
              }

              return true;
            }
          </script>

          <div class="form-group">
            <label class="col-sm-2 control-label">Foto</label>
            <div class="col-sm-2">
              <input type="file" id="file" class="form-control" name="gambar" autocomplete="off" onchange="return fileValidation()" required />
            </div>
          </div>

          <hr />
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <input type="submit" class="btn btn-info btn-submit" name="simpan" value="Simpan" id="cekbtn">
              <a href="index.php" class="btn btn-default btn-reset">Batal</a>
            </div>
          </div>

          <body>

            <div id="imagePreview"></div>
            <script>
              function fileValidation() {
                var fileInput =
                  document.getElementById('file');

                var filePath = fileInput.value;

                // Tipe file yang boleh diuploud, harus sesuai sama ini 
                var allowedExtensions =
                  /(\.bmp|\.png|\.jpeg|\.jpg)$/i;

                if (!allowedExtensions.exec(filePath)) {
                  alert('Uploud foto Anda dengan format JPG/PNG/BMP, silahkan coba kembali ya.');
                  fileInput.value = '';
                  return false;
                }
              }
            </script>

        </form>
      </div>
    </div>
  </div>
  </div>