  <div class="row">
    <div class="col-md-12">
      <div class="page-header">
        <h4>
          <i class="glyphicon glyphicon-edit"></i>
          Ubah Data Mahasiswa
        </h4>
      </div>
      <?php
      if (isset($_GET['id'])) {
        $nim   = $_GET['id'];
        $query = mysqli_query($db, "SELECT * FROM siswa WHERE nim='$nim'") or die('Query Error : ' . mysqli_error($db));
        while ($data  = mysqli_fetch_assoc($query)) {
          $nim           = $data['nim'];
          $nama          = $data['nama'];
          $jeniskelamin  = $data['jeniskelamin'];
          $agama         = $data['agama'];
          $for_query     = explode(', ', $data['olahraga']);
          $foto          = $data['gambar'];
        }
      }
      ?>
      <div class="panel panel-default">
        <div class="panel-body">
          <form class="form-horizontal" method="POST" action="proses-ubah.php" enctype="multipart/form-data">
            <input type="hidden" name="old_picture" value="<?= $foto ?>">
            <div class="form-group">
              <label class="col-sm-2 control-label">NIM</label>
              <div class="col-sm-2">
                <input type="text" class="form-control" name="nim" value="<?php echo $nim; ?>" readonly>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Nama Mahasiswa</label>
              <div class="col-sm-3">
                <input type="text" class="form-control" name="nama" autocomplete="off" value="<?php echo $nama; ?>" required>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Jenis Kelamin</label>
              <div class="col-sm-4">
                <?php
                if ($jeniskelamin == 'Laki-laki') { ?>
                  <label class="radio-inline">
                    <input type="radio" name="jeniskelamin" value="Laki-laki" checked> Laki-laki
                  </label>

                  <label class="radio-inline">
                    <input type="radio" name="jeniskelamin" value="Perempuan"> Perempuan
                  </label>
                <?php
                } else { ?>
                  <label class="radio-inline">
                    <input type="radio" name="jeniskelamin" value="Laki-laki"> Laki-laki
                  </label>

                  <label class="radio-inline">
                    <input type="radio" name="jeniskelamin" value="Perempuan" checked> Perempuan
                  </label>
                <?php
                }
                ?>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Agama</label>
              <div class="col-sm-3">
                <select class="form-control" name="agama" placeholder="Pilih Agama" required>
                  <option value="<?php echo $agama; ?>"><?php echo $agama; ?></option>
                  <option disabled>====== PILIH AGAMA ======</option>
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
                <p><input type="checkbox" name="olahraga[]" value="Sepak Bola" <?php if (in_array("Sepak Bola", $for_query)) echo "checked"; ?> /> Sepak Bola</p>
                <p><input type="checkbox" name="olahraga[]" value="Basket" <?php if (in_array("Basket", $for_query)) echo "checked"; ?> /> Basket</p>
                <p><input type="checkbox" name="olahraga[]" value="Futsal" <?php if (in_array("Futsal", $for_query)) echo "checked"; ?> /> Futsal</p>
                <p><input type="checkbox" name="olahraga[]" value="Badminton" <?php if (in_array("Badminton", $for_query)) echo "checked"; ?> /> Badminton</p>
                <p><input type="checkbox" name="olahraga[]" value="Renang" <?php if (in_array("Renang", $for_query)) echo "checked"; ?> /> Renang</p>
              </div>
            </div>

            <div class="form-group">
              <label class="col-sm-2 control-label">Foto</label>
              <div class="col-sm-2">
                <img src="pic_galih/<?php echo $foto; ?>" class="img-rounded" width="250px" height="250px" />
                <input type="file" class="form-control" name="gambar" onchange="return fileValidation()" />

              </div>
            </div>

            <hr />
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <input type="submit" class="btn btn-info btn-submit" name="simpan" value="Simpan">
                <a href="index.php" class="btn btn-default btn-reset">Batal</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>