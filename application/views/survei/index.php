<div class="card">
	<div class="card-header">
		<h3 class="card-title">Data survei</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
				<i class="fa fa-plus" aria-hidden="true"></i>
				Tambah survei
			</button>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama pembuat</th>
					<th>Judul</th>
					<th>Deskripsi</th>
					<th>Tanggal Mulai</th>
					<th>Tanggal Selesai</th>
					<th>Link Survei</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($survei as $k => $v) : ?>
					<tr>
						<td><?php echo $k + 1; ?></td>
						<td><?php echo $v->nama_pengguna; ?></td>
						<td><?php echo $v->judul; ?></td>
						<td><?php echo $v->deskripsi; ?></td>
						<td><?php echo $v->tanggal_mulai; ?></td>
						<td><?php echo $v->tanggal_selesai; ?></td>
						<td><a href="<?php echo base_url('survei/isi/'.$v->id_survei); ?>"><?php echo base_url('survei/isi/'.$v->id_survei); ?></a></td>
						<td>
							<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdit<?php echo $v->id_survei; ?>">
								<i class="fas fa-pen"></i>
								Edit
							</button>
							<a href="<?php echo site_url('survei/jawaban/' . $v->id_survei); ?>" class="btn btn-sm btn-info"><i class="fa fa-eye" aria-hidden="true"></i> Hasil Jawaban</a>
							<a href="<?php echo site_url('survei/pertanyaan/' . $v->id_survei); ?>" class="btn btn-sm btn-success"><i class="fa fa-file" aria-hidden="true"></i> Pertanyaan</a>
							<a href="<?php echo site_url('survei/delete/' . $v->id_survei); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
						</td>
					</tr>

					<!-- Modal Edit -->
					<div class="modal fade" id="modalEdit<?php echo $v->id_survei; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel<?php echo $v->id_survei; ?>" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modalEditLabel<?php echo $v->id_survei; ?>">Edit survei</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="<?php echo site_url('survei/update/' . $v->id_survei); ?>" method="POST">

									<div class="modal-body">
										<!-- Form Edit -->
										<div class="form-group">
											<label for="editNama">Judul</label>
											<input type="text" class="form-control" id="editNama" name="judul" value="<?php echo $v->judul; ?>" required>
										</div>
										<div class="form-group">
											<label for="editNama">Deskripsi</label>
											<textarea name="deskripsi" id="" class="form-control tta"><?= $v->deskripsi ?></textarea>
										</div>
										<div class="form-group">
											<label for="editNama">Tanggal Mulai</label>
											<input type="datetime-local" class="form-control" name="tanggal_mulai" value="<?php echo $v->tanggal_mulai; ?>" required>
										</div>
										<div class="form-group">
											<label for="editNama">Tanggal Selesai</label>
											<input type="datetime-local" class="form-control" name="tanggal_selesai" value="<?php echo $v->tanggal_selesai; ?>" required>
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
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTambahLabel">Tambah survei</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo site_url('survei/store'); ?>" method="POST">
				<div class="modal-body">
					<!-- Form Tambah -->
					<div class="form-group">
						<label for="editNama">Judul</label>
						<input type="text" class="form-control" id="editNama" name="judul" required>
					</div>
					<div class="form-group">
						<label for="editNama">Deskripsi</label>
						<textarea name="deskripsi" id="" class="form-control tta"></textarea>
					</div>
					<div class="form-group">
						<label for="editNama">Tanggal Mulai</label>
						<input type="datetime-local" class="form-control" name="tanggal_mulai" required>
					</div>
					<div class="form-group">
						<label for="editNama">Tanggal Selesai</label>
						<input type="datetime-local" class="form-control" name="tanggal_selesai" required>
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
