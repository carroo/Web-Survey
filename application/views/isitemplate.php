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

<body>
	<div class="app">
		<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
			<div class="container">
				<a class="navbar-brand" href="#">
					Ujian - lembar jawaban
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<!-- Left Side Of Navbar -->
					<ul class="navbar-nav me-auto">

					</ul>

					<!-- Right Side Of Navbar -->
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown">
							<a class="nav-link" data-toggle="dropdown" href="#">
								<i class="fas fa-user"></i>
								<span class="ml-1"><?= $this->session->userdata('user')['nama_pengguna'] ?></span>
							</a>
							<div class="dropdown-menu dropdown-menu-right">
								<a href="<?= base_url('Login/logout') ?>" class="dropdown-item">Logout</a>
							</div>
						</li>
					</ul>
				</div>
			</div>
		</nav>

		<!-- Main content -->
		<section class="content">
			<div class="container">
				<br>
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
	</div>

	<!-- Tambahkan script JavaScript AdminLTE dari CDN -->
	<script src="https://unpkg.com/@popperjs/core@2.11.2/dist/umd/popper.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1.0/dist/js/adminlte.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
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
</body>

</html>
