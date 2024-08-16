<div class="row">
	<div class="col-md-4">
		<div class="card">
			<div class="card-header bg-primary">
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">
					<h4><?= $survei->judul ?></h4>
				</li>
				<li class="list-group-item"><?= $survei->tanggal_mulai ?> - <?= $survei->tanggal_selesai ?></li>
			</ul>
			<div class="card-body">

				<div class="card-text">
					<?php echo $survei->deskripsi ?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-8">
		<form action="<?php echo site_url('survei/respons_store'); ?>" method="POST" enctype="multipart/form-data">
			<input type="hidden" name="id_survei" value="<?= $survei->id_survei ?>">
			<div class="row">
				<?php foreach ($pertanyaan as $k => $v) : ?>
					<input type="hidden" name="id_pertanyaan[<?= $k ?>]" value="<?= $v->id_pertanyaan ?>">
					<input type="hidden" name="tipe_pertanyaan[<?= $k ?>]" value="<?= $v->tipe_pertanyaan ?>">
					<div class="col-md-12">
						<div class="card">
							<div class="card-header bg-primary">

							</div>
							<li class="list-group-item">
								<h3 class="card-title"><?php echo $v->teks_pertanyaan; ?></h3>
							</li>

							<?php if ($v->gambar_pertanyaan) : ?>
								<li class="list-group-item">
									<img src="<?= base_url('public/gambar/' . $v->gambar_pertanyaan) ?>" style="max-width: 300px;" class="img-fluid" alt="...">
								</li>
							<?php endif; ?>
							<div class="card-body">
								<label for="jawaban">Jawaban : </label>
								<?php if ($v->tipe_pertanyaan == "essai") : ?>
									<input type="text" name="text_jawaban[<?= $k ?>]" class="form-control">
								<?php elseif ($v->tipe_pertanyaan == "pilihan_ganda") : ?>
									<?php foreach ($opsi[$k] as $ke => $va) : ?>
										<div class="form-check">
											<input class="form-check-input" type="radio" name="id_opsi_terpilih[<?= $k ?>]" value="<?= $va->id_opsi ?>" id="radio-<?= $va->id_opsi ?>">
											<label class="form-check-label" for="radio-<?= $va->id_opsi ?>">
												<?= $va->teks_opsi ?>
											</label>
										</div>
									<?php endforeach; ?>
								<?php elseif ($v->tipe_pertanyaan == "checkbox") : ?>
									<?php foreach ($opsi[$k] as $ke => $va) : ?>
										<div class="form-check">
											<input class="form-check-input" type="checkbox" name="id_opsi_terpilih[<?= $k ?>][<?= $ke ?>]" value="<?= $va->id_opsi ?>" id="check-<?= $va->id_opsi ?>">
											<label class="form-check-label" for="check-<?= $va->id_opsi ?>">
												<?= $va->teks_opsi ?>
											</label>
										</div>
									<?php endforeach; ?>
								<?php elseif ($v->tipe_pertanyaan == "file") : ?>
									<input type="file" name="path_unggahan_file[<?= $k ?>]" class="form-control">
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<button type="submit" class="btn btn-primary">Kirim</button>
						</div>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
