<div class="row">
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Data survei</h3>
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
		<div class="card">
			<div class="card-header">
				<h3 class="card-title">Data Pertanyaan</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
						<i class="fa fa-plus" aria-hidden="true"></i>
						Tambah pertanyaan
					</button>
				</div>
			</div>
			<div class="card-body">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th>No</th>
							<th>Tipe</th>
							<th>Pertanyaan</th>
							<th>Gambar</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($pertanyaan as $k => $v) : ?>
							<tr>
								<td><?php echo $k + 1; ?></td>
								<td><?php echo $v->tipe_pertanyaan; ?></td>
								<td><?php echo $v->teks_pertanyaan; ?></td>
								<td>
									<?php if ($v->gambar_pertanyaan) : ?>
										<img src="<?= base_url('public/gambar/' . $v->gambar_pertanyaan) ?>" width="80px" class="img-fluid" alt="...">
									<?php else : ?>
										tidak ada
									<?php endif; ?>
								</td>
								<td>
									<a href="<?php echo site_url('survei/pertanyaan_delete/' . $v->id_pertanyaan); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambahLabel">Tambah pertanyaan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo site_url('survei/pertanyaan_store'); ?>" method="POST" enctype="multipart/form-data">
				<div class="modal-body">
					<!-- Form Tambah -->
					<div class="form-group">
						<label for="editNama">Tipe</label>
						<input type="hidden" name="id_survei" value="<?= $survei->id_survei ?>">
						<select name="tipe_pertanyaan" class="form-control" id="" required>
							<option value="essai" selected>essai</option>
							<option value="pilihan_ganda">pilihan ganda</option>
							<option value="checkbox">checkbox</option>
							<option value="file">file</option>
						</select>
					</div>
					<div class="form-group">
						<label for="editNama">teks pertanyaan</label>
						<textarea name="teks_pertanyaan" id="" class="form-control tta"></textarea>
					</div>
					<div class="form-group">
						<label for="editNama">gambar pertanyaan (optional)</label>
						<input type="file" name="gambar_pertanyaan" class="form-control">
					</div>
					<div id="opsi">
						<label for="">Opsi</label>
						<div class="row px-2">
							<div class="input-group">
								<input type="text" class="form-control" name="teks_opsi[]">
								<div class="input-group-append tambah">
									<span class="input-group-text bg-success"><i class="fas fa-plus"></i></span>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
					<button type="submit" class="btn btn-primary">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>
