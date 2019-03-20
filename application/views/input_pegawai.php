<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Tambah Pegawai</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url("assets/") ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url("assets/") ?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url("assets/") ?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url("assets/") ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url("assets/") ?>dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?= base_url("assets/") ?>dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <!-- header -->
  <?php
    include_once("includes/header.php");
  ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php
    include_once("includes/left.php");
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pegawai
        <small>Tambah Pegawai</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Pegawai</a></li>
        <li class="active">Tambah Pegawai</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          

          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Pegawai</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              

              <div class="row">
                <div class="col-md-6">
                  <?php echo form_open('pegawai/tambah'); ?>
                  <div class="form-group">
                    <label for="nip">NIP</label>
                    <input type="text" class="form-control" placeholder="NIP" name="nip">
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama Pegawai</label>
                    <input type="text" class="form-control" placeholder="Nama pegawai.." name="nama_lengkap">
                  </div>
                  <div class="form-group">
                    <label>Jabatan</label>
                    <select name="id_jabatan" class="form-control select2" style="width: 100%;">
                      <?php 
                      $json_string     = 'http://localhost/ujici/index.php/api/jabatan';
                      $jsondata        = file_get_contents($json_string);
                      $obj             = json_decode($jsondata, true);
                      $jj = $obj['data'];
                      foreach ($jj as $j) {
                    ?>
                      <option value="<?php echo $j['id_jabatan']; ?>"><?php echo $j['nama_jabatan']; ?></option>
                    <?php } ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control select2" style="width: 100%;">
                      <option value="0">Tidak aktif</option>
                      <option value="1">Aktif</option>
                    </select>
                  </div>
                  <div class="col-xs-4">
                    <button name="submit" type="submit" class="btn btn-primary btn-block btn-flat">Tambah</button>
                  </div>
                  <?php echo form_close(); ?>
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php
    include_once("includes/footer.php");
  ?>   
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?= base_url("assets/") ?>bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url("assets/") ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- DataTables -->
<script src="<?= base_url("assets/") ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?= base_url("assets/") ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?= base_url("assets/") ?>bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?= base_url("assets/") ?>bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url("assets/") ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url("assets/") ?>dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
</body>
</html>
