<?php
if (isset($_POST['cari'])) {
  $cari = $_POST['cari'];
} else {
  $cari = "";
}
?>

<div class="row">
  <div class="col-md-12">
    <div class="page-header">
      <h4>
        <i class="glyphicon glyphicon-user"></i> Data Mahasiswa

        <div class="pull-right btn-tambah">
          <form class="form-inline" method="POST" action="index.php">
            <div class="form-group">
              <div class="input-group">
                <div class="input-group-addon">
                  <i class="glyphicon glyphicon-search"></i>
                </div>
                <input type="text" class="form-control" name="cari" placeholder="Cari ..." autocomplete="off" value="<?php echo $cari; ?>">
              </div>
            </div>
            <a class="btn btn-info" href="?page=tambah">
              <i class="glyphicon glyphicon-plus"></i> Tambah Data</a>
            <a class="btn btn-warning" href="../../praktikum.php">Kembali Ke Web</a>
          </form>
        </div>

      </h4>
    </div>

    <?php
    if (empty($_GET['alert'])) {
      echo "";
    } elseif ($_GET['alert'] == 1) {
      echo "<div class='alert alert-danger alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='glyphicon glyphicon-alert'></i> Gagal!</strong> Terjadi kesalahan.
          </div>";
    } elseif ($_GET['alert'] == 2) {
      echo "<div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data Mahasiswa berhasil disimpan.
          </div>";
    } elseif ($_GET['alert'] == 3) {
      echo "<div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data Mahasiswa berhasil diubah.
          </div>";
    } elseif ($_GET['alert'] == 4) {
      echo "<div class='alert alert-success alert-dismissible' role='alert'>
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
              <span aria-hidden='true'>&times;</span>
            </button>
            <strong><i class='glyphicon glyphicon-ok-circle'></i> Sukses!</strong> Data Mahasiswa berhasil dihapus.
          </div>";
    }
    ?>

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Data Mahasiswa</h3>
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th>No.</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Agama</th>
                <th>Olahraga Favorit</th>
                <th>Foto</th>
                <th>Aksi</th>
              </tr>
            </thead>

            <tbody>
              <?php
              $batas = 5;

              if (isset($cari)) {
                $jumlah_record = mysqli_query($db, "SELECT * FROM siswa
                                                    WHERE nim LIKE '%$cari%' OR nama LIKE '%$cari%'")
                  or die('Ada kesalahan pada query jumlah_record: ' . mysqli_error($db));
              } else {
                $jumlah_record = mysqli_query($db, "SELECT * FROM siswa")
                  or die('Ada kesalahan pada query jumlah_record: ' . mysqli_error($db));
              }

              $jumlah  = mysqli_num_rows($jumlah_record);
              $halaman = ceil($jumlah / $batas);
              $page    = (isset($_GET['hal'])) ? (int)$_GET['hal'] : 1;
              $mulai   = ($page - 1) * $batas;

              /*-------------------------------------------------------------------*/
              $no = 1;
              if (isset($cari)) {
                $query = mysqli_query($db, "SELECT * FROM siswa
                                            WHERE nim LIKE '%$cari%' OR nama LIKE '%$cari%' 
                                            ORDER BY nim DESC LIMIT $mulai, $batas")
                  or die('Ada kesalahan pada query siswa: ' . mysqli_error($db));
              } else {
                $query = mysqli_query($db, "SELECT * FROM siswa
                                            ORDER BY nim DESC LIMIT $mulai, $batas")
                  or die('Ada kesalahan pada query siswa: ' . mysqli_error($db));
              }

              while ($data = mysqli_fetch_assoc($query)) {

                echo "  <tr>
                      <td width='50' class='center'>$no</td>
                      <td width='100'>$data[nim]</td>
                      <td width='150'>$data[nama]</td>
                      <td width='120'>$data[jeniskelamin]</td>
                      <td width='120'>$data[agama]</td>
                      <td width='120'>$data[olahraga]</td>
                      <td width='120'><img src='pic_galih/" . $data['gambar'] . "' width='100' height='100'</td>
                     

                      <td width='100'>
                        <div class=''>
                          <a data-toggle='tooltip' data-placement='top' title='Ubah' style='margin-right:5px' class='btn btn-info btn-sm' href='?page=ubah&id=$data[nim]'>
                            <i class='glyphicon glyphicon-edit'></i>
                          </a>";
              ?>
                <a data-toggle="tooltip" data-placement="top" title="Hapus" class="btn btn-danger btn-sm" href="proses-hapus.php?id=<?php echo $data['nim']; ?>" onclick="return confirm('Anda yakin ingin menghapus siswa <?php echo $data['nama']; ?>?');">
                  <i class="glyphicon glyphicon-trash"></i>
                </a>
              <?php
                echo "
                        </div>
                      </td>
                    </tr>";
                $no++;
              }
              ?>
            </tbody>
          </table>
          <?php
          if (empty($_GET['hal'])) {
            $halaman_aktif = '1';
          } else {
            $halaman_aktif = $_GET['hal'];
          }
          ?>

          <a>
            Halaman <?php echo $halaman_aktif; ?> dari <?php echo $halaman; ?> |
            Total <?php echo $jumlah; ?> data
          </a>

          <nav>
            <ul class="pagination pull-right">
              <!-- Button untuk halaman sebelumnya -->
              <?php
              if ($halaman_aktif <= '1') { ?>
                <li class="disabled">
                  <a href="" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
              <?php
              } else { ?>
                <li>
                  <a href="?hal=<?php echo $page - 1 ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                  </a>
                </li>
              <?php
              }
              ?>

              <!-- Link halaman 1 2 3 ... -->
              <?php
              for ($x = 1; $x <= $halaman; $x++) { ?>
                <li class="">
                  <a href="?hal=<?php echo $x ?>"><?php echo $x ?></a>
                </li>
              <?php
              }
              ?>

              <!-- Button untuk halaman selanjutnya -->
              <?php
              if ($halaman_aktif >= $halaman) { ?>
                <li class="disabled">
                  <a href="" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              <?php
              } else { ?>
                <li>
                  <a href="?hal=<?php echo $page + 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                  </a>
                </li>
              <?php
              }
              ?>
            </ul>
          </nav>
        </div>
      </div>
    </div> 
  </div> 
</div> 