<?php
session_start();
if ($_SESSION['user'] == '') {
  header("location:../index.php");
}
?>
<?php
include '../_database/config.php'; //panggil setiap ingin koneksi ke data
$no = 0;
$no2 = $no++;
$query = mysqli_query($koneksi, 'SELECT * FROM suratmahasiswa ORDER BY id_no DESC');
$data = $data = mysqli_fetch_array($query)


?>
<?php
include "../_database/config.php";
if (isset($_POST['update'])) {
  $nama_file2 = basename($_FILES['ufl']['name']);
  $id3 = $_POST['id2'];
  $nol = $_POST['stats2'];

  $url2 = $id3 . '_' . $nama_file2;

  if (move_uploaded_file($_FILES['ufl']['tmp_name'], $url2)) {

    $query2 = mysqli_query($koneksi, "UPDATE suratmahasiswa SET `file`='$url2' WHERE id_no = '$id3' ");
    $query3 = mysqli_query($koneksi, "UPDATE suratmahasiswa SET `status_surat`='$nol' WHERE id_no = '$id3' ");

    if ($query2 && $query3) {
      echo '<a href="./pmhnsurat.php"><script> alert ("Berhasil di ajukan")</script></a>';
?>
      <script>
        history.pushState({}, "", "")
      </script> <?php
              } else {
                echo '<a href="./pmhnsurat.php"><script> alert ("gagal di ajukan")</script></a>';
              }
            }
          }

                ?>

<!-- php update surat saat kadep menolak -->
<?php
include "../_database/config.php";
if (isset($_POST['update2'])) {

  $nama_file3 = basename($_FILES['uflk']['name']);
  $id4 = $_POST['id2'];
  $nol = $_POST['stats2'];

  $url3 = $id4 . '_' . $nama_file3;

  if (move_uploaded_file($_FILES['uflk']['tmp_name'], $url3)) {

    $query4 = mysqli_query($koneksi, "UPDATE suratmahasiswa SET `file`='$url3' WHERE id_no = '$id4' ");
    $query5 = mysqli_query($koneksi, "UPDATE suratmahasiswa SET `status_kadep`='$nol' WHERE id_no = '$id4' ");

    if ($query4 && $query5) {
      echo '<a href="./pmhnsurat.php"><script> alert ("Berhasil di ajukan")</script></a>';
?> <script>
        history.pushState({}, "", "")
      </script> <?php
              } else {
                echo '<a href="./pmhnsurat.php"><script> alert ("gagal di ajukan")</script></a>';
              }
            }
          }

                ?>
<?php
include "../_database/config.php";
if (isset($_POST['hapus'])) {
  $id6 = $_POST['id'];
  $query = mysqli_query($koneksi, "SELECT * FROM suratmahasiswa WHERE id_no = '$id6'");
  $data = mysqli_fetch_assoc($query);
  $nama_file = $data['file'];
  $target_file = "./$nama_file";


  unlink("$target_file");
  $query6 = mysqli_query($koneksi, "DELETE FROM suratmahasiswa  WHERE id_no = '$id6' ");

  if ($query6) {
?><script>
      <?php $_SESSION['sukseshps'] = true; ?>
    </script>
    <script>
      history.pushState({}, "", "")
    </script><?php
              ?> <script>
      history.pushState({}, "", "")
    </script>
<?php } else {
    echo '<script> alert ("gagal di ajukan")</script></a>';
  }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/images/favicon.png">
  <title>
    Sistem Administrasi DTEO
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />

  <style>
    .scrollbar-deep-purple::-webkit-scrollbar-track {
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
      background-color: #F5F5F5;
      border-radius: 10px;
    }

    .scrollbar-deep-purple::-webkit-scrollbar {
      width: 12px;
      background-color: #F5F5F5;
    }

    .scrollbar-deep-purple::-webkit-scrollbar-thumb {
      border-radius: 10px;
      -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.1);
      background-color: #aaa;
    }

    .scrollbar-deep-purple {
      scrollbar-color: #512da8 #F5F5F5;
    }

    .bordered-deep-purple::-webkit-scrollbar-track {
      -webkit-box-shadow: none;
      border: 1px solid #ffffff00;
    }

    .bordered-deep-purple::-webkit-scrollbar-thumb {
      -webkit-box-shadow: none;
    }

    .thin::-webkit-scrollbar {
      width: 6px;
    }

    .example-1 {
      position: relative;
      overflow-y: scroll;
      height: 200px;
    }
  </style>

</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="">

        <span class="ms-0 font-weight-bold">Sistem Administrasi Mahasiswa</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <!--Home-->
        <li class="nav-item">
          <a class="nav-link  " href="./mahasiswa.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">Home</span>
          </a>
        </li>

             <!--persetujuan surat-->
             <li class="nav-item">
          <a class="nav-link  " href="./pmhnsurat.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">Permohonan Surat</span>
          </a>
        </li>

          <!--Permohonan Surat-->
          <li class="nav-item">
            <a class="nav-link  active" href="../pagesmahasiswa/pmhnsurat.php">
              <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text" viewBox="0 0 16 16">
                  <path d="M5.5 7a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zM5 9.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5zm0 2a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5z" />
                  <path d="M9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.5L9.5 0zm0 1v2A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5z" />
                </svg>
              </div>
              <span class="nav-link-text ms-1">Bimbingan Proposal </span>
            </a>
          </li>

      

        <!--persetujuan surat-->
        <li class="nav-item">
          <a class="nav-link  " href="./permohonanpmb.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-text-fill" viewBox="0 0 16 16">
                <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zM4.5 9a.5.5 0 0 1 0-1h7a.5.5 0 0 1 0 1h-7zM4 10.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm.5 2.5a.5.5 0 0 1 0-1h4a.5.5 0 0 1 0 1h-4z" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">Permohonan Dosbing</span>
          </a>
        </li>

        <!-- REKAP SURAT -->
        <li class="nav-item">
          <a class="nav-link  " href="./rekapmhs.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-text-fill" viewBox="0 0 16 16">
                <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zM5 4h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm-.5 2.5A.5.5 0 0 1 5 6h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1-.5-.5zM5 8h6a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1zm0 2h3a.5.5 0 0 1 0 1H5a.5.5 0 0 1 0-1z" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">Rekap Surat</span>
          </a>
        </li>

        <!--profil-->
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="../profile.php">
            <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shield-lock-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 0c-.69 0-1.843.265-2.928.56-1.11.3-2.229.655-2.887.87a1.54 1.54 0 0 0-1.044 1.262c-.596 4.477.787 7.795 2.465 9.99a11.777 11.777 0 0 0 2.517 2.453c.386.273.744.482 1.048.625.28.132.581.24.829.24s.548-.108.829-.24a7.159 7.159 0 0 0 1.048-.625 11.775 11.775 0 0 0 2.517-2.453c1.678-2.195 3.061-5.513 2.465-9.99a1.541 1.541 0 0 0-1.044-1.263 62.467 62.467 0 0 0-2.887-.87C9.843.266 8.69 0 8 0zm0 5a1.5 1.5 0 0 1 .5 2.915l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99A1.5 1.5 0 0 1 8 5z" />
              </svg>
            </div>
            <span class="nav-link-text ms-1">Ganti Password</span>
          </a>
        </li>

      </ul>
    </div>

  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Sistem Administrasi Mahasiswa</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Bimbingan Proposal</li>
          </ol>
          <h5 class="font-weight-bolder mb-0">Bimbingan Proposal</h5>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">

          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="../profile.php" class="nav-link text-body font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none"><?php echo $_SESSION['user'] ?></span>
              </a>
            </li>

            <li class="nav-item px-3 d-flex align-items-center">

            </li>
            <li class="nav-item d-flex align-items-center">
              <a href="../logout.php" href="javascript:;" class="nav-link text-body p-0">
                <i class="fas fa-sign-out-alt"></i>
                <span class="d-sm-inline d-none">Logout </span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- End Navbar -->
    <div class="text-center">
      <a class="nav-link  " href="./ajukanbimbingan.php">
        <button type="button" class="btn btn-secondary btn-lg w-95 btn bg-gradient-info">Ajukan Bimbingan</button>
      </a>
    </div>


    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-6 d-flex align-items-center mb-3 pb-3">
                  <h6 class="mb-0">Status Bimbingan</h6>
                </div>
              </div>
            </div>


            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0 scrollbar-deep-purple bordered-deep-purple thin mt-0 mb-0 pt-0" style="height:375px">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-center">No</th>
                      <th class="text-left ps-1">Perihal</th>
                      <th class="text-left ps-1">Keterangan</th>
                      <th class="text-center">Waktu Upload</th>
                      <th class="text-center">Persetujuan</th>
                      <th class="text-center">Catatan</th>
                      <th class="text-center">Edit/Hapus</th>
                    </tr>
                  </thead>
                  <tbody id="myTable">

                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM bimbingan ORDER BY tanggal DESC");
                    while ($data = mysqli_fetch_array($query)) {
                      if ($data['nama'] == $_SESSION['user']) {
                    ?>
                        <tr>
                          <td class="text-center"><?php echo $no++ ?></td>
                          <td class="text-left ps-1"><?php echo $data['perihal'] ?></td>
                          <td class="text-left ps-1"><?php echo $data['keterangan'] ?></td> <!-- nanti dibuat modal pop up aja buat keterangannya -->
                          <td class="text-left ps-1"><?php echo $data['tanggal'] ?></td>
                          <!-- status surat dosen1  -->
                          <?php if ($data['status_dosen1'] == 0 || $data['status_dosentkk'] == 0) { ?>
                            <td class="align-middle text-center text-sm">
                              <span class="badge badge-sm bg-gradient-secondary" value="<?php echo $data['status_dosen1'] ?>">Menunggu Revisi</span>
                            </td> <?php } else if ($data['status_dosen1'] == 1 || $data['status_dosentkk'] == 1) { ?>
                            <td class="align-middle text-center text-sm">
                              <span class="badge badge-sm bg-gradient-danger" value="<?php echo $data['status_dosen1'] ?>">Perlu Revisi</span>
                            </td>
                          <?php } else if ($data['status_dosen1'] == 2 || $data['status_dosentkk'] == 2) { ?>
                            <td class="align-middle text-center text-sm">
                              <span class="badge badge-sm bg-gradient-success" value="<?php echo $data['status_dosen1'] ?>">Bimbingan Selesai</span>
                            </td>
                          <?php } ?>
                          <td class="align-middle text-center">
                            <button id="button" name="id" value="<?php echo $data['id_no'] ?>" type="submit" class="btn btn-default btn-sm" onclick="openWindowWithPost(<?php echo $data['id_no'] ?>)">Lihat</button>
                          </td>
                          <!-- button edit -->
                          <td class="align-middle text-center">
                            <a href="javascript:;">
                              <button type="button" class="btn btn-default btn-sm" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['id_no'] ?>">Edit</button>
                            </a>
                          </td>

                          <!-- Modal -->
                          <div class="modal fade" id="edit<?php echo $data['id_no'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">
                                <!-- popup ajuan surat mahasiswa -->
                                <div class="modal-header">
                                  <h5 class="modal-title" id="edit<?php echo $data['id_no'] ?>">Catatan</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>

                                <div class="modal-body">

                                  <div class="card-header pb-0 p-3">
                                    <div class="row">
                                      <div class="mb-3">
                                        <!-- Cek File -->
                                        <label for="formFile" class="form-label">File Anda (Klik Untuk Melihat)</label>
                                        <a href="./<?php echo $data['file'] ?>" target="_blank">
                                          <p class="modal-title" name="fl" id="edit<?php echo $data['id_no'] ?>">
                                            <button type="button" class="btn btn-link"><em><?php echo $data['file'] ?></em></button>
                                          </p>
                                        </a>

                                        <!-- Keterangan File -->
                                        <?php if ($data['perihal'] == "Surat Pengajuan Kegiatan HIMA") { ?>
                                          <label for="formFile" class="form-label">Nama Kegiatan</label>
                                        <?php } else { ?>
                                          <label for="formFile" class="form-label">Tempat Pelaksanaan</label>
                                        <?php } ?>
                                        <label name="keterangan" class="form-control" aria-label="default input example"><?php echo $data['keterangan'] ?></label>
                                        <!-- catatan dosebing -->
                                        <label for="formFile" class="form-label">Catatan Terbaru</label>
                                        <label name="catatan" class="form-control" aria-label="default input example"><?php echo $data['catatan_pmb'] ?></label>

                                        <!-- Input ID untuk memberikan identitas surat -->
                                        <input type="hidden" name="id" value="<?php echo $data['id_no'] ?>">

                                        <div class="modal-footer">
                                          <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>
                                          <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus<?php echo $data['id_no'] ?>">Hapus</button>
                                          <?php if ($data['status_dosen1'] == 1 || $data['status_dosentkk'] == 1) { ?>
                                            <form action="./lihatcatatan.php" method="post">
                                              <!-- Input ID untuk memberikan identitas surat -->
                                              <input type="hidden" name="lokasi" value="pmhn">
                                              <input type="hidden" name="id" value="<?php echo $data['id_no'] ?>">
                                              <button class="btn btn-info">Ubah</button>
                                            </form>
                                          <?php } ?>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>

                            </div>
                          </div>

                          <!-- Modal Hapus -->
                          <div class="modal fade" id="hapus<?php echo $data['id_no'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                              <div class="modal-content">

                                <!-- popup ajuan surat mahasiswa -->
                                <div class="modal-header">
                                  <h5 class="modal-title" id="hapus<?php echo $data['id_no'] ?>">Hapus File</h5>
                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                  </button>
                                </div>


                                <div class="modal-body">
                                  <form action="" method="post" enctype="multipart/form-data">
                                    <div class="card-header pb-0 p-3">
                                      <div class="row">
                                        <div class="mb-3">

                                          <!-- Nama File -->
                                          <label for="formFile" class="form-label">Nama File</label>
                                          <label name="flhps" class="form-control" aria-label="default input example"><?php echo $data['file'] ?></label>

                                          <!-- NRP mahasiswa -->
                                          <label for="formFile" class="form-label">Perihal</label>
                                          <label name="prhlhps" class="form-control" aria-label="default input example"><?php echo $data['perihal'] ?></label>

                                          <!-- Lihat File -->
                                          <label for="formFile" class="form-label">File Yang Akan Dihapus</label>
                                          <a href="./<?php echo $data['file'] ?>" target="_blank">
                                            <h6 class="modal-title" name="fl" id="hapus<?php echo $data['id_no'] ?>"><button type="button" class="btn btn-link"><em><?php echo $data['file'] ?></em></button></h6>
                                          </a>

                                          <!-- Input ID untuk memberikan identitas surat -->
                                          <input type="hidden" name="id" value="<?php echo $data['id_no'] ?>">

                                          <!-- Memberi peringatan -->
                                          <h5 class="text-danger modal-title text-center">APAKAH ANDA YAKIN ?</h5>
                                          <h6 class=" modal-title text-center">MENGHAPUS FILE BERARTI MENGHILANGKAN SELURUH DATA PERSETUJUAN</h6>


                                        </div>
                                      </div>
                                    </div>
                                </div>


                                <div class="modal-footer">
                                  <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Tutup</button>

                                  <!-- Saat dosen menolak -->
                                  <button type="submite" name="hapus" class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#edit<?php echo $data['id_no'] ?>">Hapus</button>

                                </div>

                                </form>

                              </div>
                            </div>
                          </div>
                      <?php }
                    }  ?>
                        </tr>
                  </tbody>
                  <?php if ($no == 1) { ?>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-center">
                      <h6 class="font-weight-bold">BELUM ADA SURAT YANG DIAJUKAN</h6>
                    </td>
                  <?php } ?>
                </table>

                <!-- php update surat -->


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
    include "../_database/config.php";
    if (isset($_POST['hapus'])) {
      $id6 = $_POST['id'];
      $query = mysqli_query($koneksi, "SELECT * FROM bimbingan WHERE id_no = '$id6'");
      $data = mysqli_fetch_assoc($query);
      $nama_file = $data['file'];
      $target_file = "./$nama_file";


      unlink("$target_file");
      $query6 = mysqli_query($koneksi, "DELETE FROM bimbingan  WHERE id_no = '$id6' ");

      if ($query6) {
    ?><script>
          <?php $_SESSION['sukseshps'] = true; ?>
        </script>
        <script>
          history.pushState({}, "", "")
        </script><?php
                  ?> <script>
          history.pushState({}, "", "")
        </script>
    <?php } else {
        echo '<script> alert ("gagal di ajukan")</script></a>';
      }
    }


    ?>

  </main>

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.3"></script>

  <script type="text/javascript">
    function openWindowWithPost(id) {
      var f = document.getElementById('button');
      f.id.value = id;
      window.open('administration.cypiral.org/pagesmahasiswa/tabelrekap.php?id=' + id, 'MsgWindows', 'width=800, height=500');
      f.submit();
    }
  </script>
  
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php if (@$_SESSION['sukses']) : ?>
    <script>
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Berhasil Mengirimkan',
        showConfirmButton: false,
        timer: 2000
      })
    </script>
    <?php unset($_SESSION['sukses']); ?>
  <?php endif; ?>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php if (@$_SESSION['sukseshps']) : ?>
    <script>
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Berhasil Menghapus',
        showConfirmButton: false,
        timer: 2000
      })
    </script>
    <?php unset($_SESSION['sukseshps']); ?>
  <?php endif; ?>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php if (@$_SESSION['pdf']) : ?>
    <script>
      Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Berhasil Menghapus',
        showConfirmButton: false,
        timer: 2000
      })
    </script>
    <?php unset($_SESSION['pdf']); ?>
  <?php endif; ?>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <?php if (@$_SESSION['input']) : ?>
    <script>
      Swal.fire({
        position: 'center',
        icon: 'error',
        title: 'Gagal Input',
        showConfirmButton: false,
        timer: 2000
      })
    </script>
    <?php unset($_SESSION['input']); ?>
  <?php endif; ?>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
      });
    });
  </script>
</body>

</html>