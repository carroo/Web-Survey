<div class="row">
	
	<div class="col-lg-3 col-6">
		<div class="small-box bg-warning">
			<div class="inner">
				<h3><?= count($survei);?></h3>
				<p>survei</p>
			</div>
			<div class="icon">
				<i class="fas fa-file"></i>
			</div>
			<a href="<?= base_url('survei') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<?php if ($this->session->userdata('user')['role'] == 0) : ?>
	<div class="col-lg-3 col-6">
		<div class="small-box bg-danger">
			<div class="inner">
				<h3><?= count($pengguna);?></h3>
				<p>Pengguna</p>
			</div>
			<div class="icon">
				<i class="fas fa-user-tie"></i>
			</div>
			<a href="<?= base_url('pengguna') ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
		</div>
	</div>
	<?php endif; ?>
</div>
