<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<!-- AdminLTE CSS -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.0.4/dist/css/adminlte.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body class="hold-transition login-page">
	<div class="login-box">
		<div class="login-logo">
			<a href="#"><b>Kue</b>Tra</a>
		</div>
		<!-- /.login-logo -->
		<div class="card">
			<div class="card-body login-card-body">
				<p class="login-box-msg">Silahkan Login Terlebih Dahulu</p>

				<form action="<?= base_url('Login/proses_login') ?>" method="post">
					<!-- Replace "process_login.php" with your form handling script -->
					<div class="input-group mb-3">
						<input type="email" class="form-control" placeholder="Email" name="email" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-envelope"></span>
							</div>
						</div>
					</div>
					<div class="input-group mb-3">
						<input type="password" class="form-control" placeholder="Password" name="password" required>
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
					</div>
					<div class="row">
						<!-- /.col -->
						<div class="col-12">
							<button type="submit" class="btn btn-primary w-100 btn-block">Login</button>
						</div>
						<!-- /.col -->
					</div>
				</form>

				<p class="mb-0">
					<a href="<?= base_url('Login/register') ?>">Belum Punya Akun?</a>
				</p>
			</div>
			<!-- /.login-card-body -->
		</div>
	</div>
	<!-- AdminLTE JS -->
	<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.0.4/dist/js/adminlte.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
