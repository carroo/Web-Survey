<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title; ?></title>
	<!-- Tambahkan link CSS AdminLTE dari CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
	<!-- Tambahkan Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
	<div class="wrapper">
		<!-- Bagian Header -->
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
				</li>
			</ul>

			<!-- Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<li class="nav-item dropdown">
					<a class="nav-link" data-toggle="dropdown" href="#">
						<i class="fas fa-user"></i>
						<span class="ml-1"><?= $this->session->userdata('user')['nama_pengguna'] ?></span>
					</a>
					<div class="dropdown-menu dropdown-menu-right">
						<!-- <a href="<?= base_url('profile') ?>" class="dropdown-item">Profile</a> -->
						<div class="dropdown-divider"></div>
						<a href="<?= base_url('Login/logout') ?>" class="dropdown-item">Logout</a>
					</div>
				</li>
			</ul>
		</nav>

		<!-- Bagian Sidebar -->
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<!-- Brand Logo -->
			<a href="#" class="brand-link">
				<img src="<?= base_url('public/logo/logo petra.png') ?>" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				<span class="brand-text font-weight-light">KueTra</span>
			</a>

			<!-- Sidebar -->
			<div class="sidebar">
				<!-- Sidebar Menu -->
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<div class="user-panel mt-3 pb-3 mb-3 d-flex">
							<div class="image">
								<img class="img-circle elevation-2" alt="User Image" src="<?= base_url('user.png') ?>">
							</div>
							<div class="info">
								<a href="#" class="">
									<span><?= $this->session->userdata('user')['nama_pengguna'] ?></span>
								</a>
							</div>
						</div>

						<li class="nav-item">
							<a href="<?php echo site_url('dashboard'); ?>" class="nav-link <?php echo (current_url() == site_url('dashboard')) ? 'active' : ''; ?>">
								<i class="nav-icon fas fa-home"></i>
								<p>
									Dashboard
								</p>
							</a>
						</li>
						<?php if ($this->session->userdata('user')['role'] == 0) : ?>
							<li class="nav-item">
								<a href="<?php echo site_url('pengguna'); ?>" class="nav-link <?php echo (current_url() == site_url('pengguna')) ? 'active' : ''; ?>">
									<i class="nav-icon fas fa-users"></i>
									<p>
										Pengguna
									</p>
								</a>
							</li>
						<?php endif; ?>
						<li class="nav-item">
							<a href="<?php echo site_url('survei'); ?>" class="nav-link <?php echo (strpos(current_url(), 'survei/survei') !== false) ? 'active' : ''; ?>">
								<i class="nav-icon fas fa-file"></i>
								<p>
									Survei
								</p>
							</a>
						</li>


					</ul>
				</nav>

				<!-- /.sidebar-menu -->
			</div>
			<!-- /.sidebar -->
		</aside>

		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">

			<!-- Main content -->
			<section class="content">
				<div class="container-fluid">
					<br>
					<div class="row mb-2">
						<div class="col-sm-12">
							<h1 class="m-1"><?= $title ?></h1>
						</div>
					</div>
					<?php if (validation_errors()) : ?>
						<div class="alert alert-danger">
							<ul>
								<?php echo validation_errors('<li>', '</li>'); ?>
							</ul>
						</div>
					<?php endif; ?>
					<?php echo $content; ?>
				</div>
			</section>
			<!-- /.content -->

		</div>
		<!-- /.content-wrapper -->

		<!-- Main Footer -->
		<footer class="main-footer">
			<div class="float-right d-none d-sm-inline">
				KueTra
			</div>
			<strong>KueTra App &copy; <?= date('Y') ?></strong>
		</footer>
	</div>

	<!-- Tambahkan script JavaScript AdminLTE dari CDN -->
	<script src="https://unpkg.com/@popperjs/core@2.11.2/dist/umd/popper.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
	<script src="https://cdn.tiny.cloud/1/3dntiltfrunwr0q2h8i435iwredcqbe0o1zo4x47pqhh86c5/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
	<?php
	// Check if there are any flash data messages to display
	if ($this->session->flashdata('success')) {
		echo '<script>Swal.fire("Success!", "' . $this->session->flashdata('success') . '", "success");</script>';
	}

	if ($this->session->flashdata('error')) {
		echo '<script>Swal.fire("Error!", "' . $this->session->flashdata('error') . '", "error");</script>';
	}
	?>
	<script>
		$(document).ready(function() {
			$('.table:not(.not)').DataTable({
				dom: 'Bfrtip',
				buttons: [{
						extend: 'copy',
						exportOptions: {
							columns: ':not(:last-child)'
						}
					},
					{
						extend: 'csv',
						exportOptions: {
							columns: ':not(:last-child)'
						}
					},
					{
						extend: 'excel',
						exportOptions: {
							columns: ':not(:last-child)'
						}
					},
					{
						extend: 'pdf',
						exportOptions: {
							columns: ':not(:last-child)'
						}
					},
					{
						extend: 'print',
						exportOptions: {
							columns: ':not(:last-child)'
						}
					},

				],
			});
			tinymce.init({
				selector: ".tta",
				height: 200,
				toolbar: "undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code", // Atur toolbar dengan tombol yang diinginkan
				menubar: false, // Nonaktifkan bar menu atas
			});
		});
	</script>
	<script>
		$(document).ready(function() {
			// Hide the "opsi" div on page load
			$("#opsi").hide();

			// Show/hide the "opsi" div based on the selected value
			$("select[name='tipe_pertanyaan']").change(function() {
				var selectedTipe = $(this).val();
				if (selectedTipe === "pilihan_ganda" || selectedTipe === "checkbox") {
					$("#opsi").show();
				} else {
					$("#opsi").hide();
				}
			});

			// Add new input field when the plus icon is clicked
			$("#opsi").on("click", ".tambah", function() {
				var newInputField = '<div class="row px-2"><div class="input-group"><input type="text" class="form-control" name="teks_opsi[]"><div class="input-group-append kurang"><span class="input-group-text bg-danger"><i class="fas fa-minus"></i></span></div></div></div>';
				$("#opsi").append(newInputField);
			});

			// Remove input field when the minus icon is clicked
			$("#opsi").on("click", ".kurang", function() {
				$(this).closest(".row").remove();
			});
		});
	</script>
</body>

</html>
