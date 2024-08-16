<div class="card">
	<div class="card-header">
		<h3 class="card-title">Data pengguna</h3>
		<div class="card-tools">
			<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
				<i class="fa fa-plus" aria-hidden="true"></i>
				Tambah pengguna
			</button>
		</div>
	</div>
	<div class="card-body">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No</th>
					<th>Nama pengguna</th>
					<th>Email</th>
					<th>Role</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($pengguna as $k => $v) : ?>
					<tr>
						<td><?php echo $k + 1; ?></td>
						<td><?php echo $v->nama_pengguna; ?></td>
						<td><?php echo $v->email; ?></td>
						<td><?php echo $v->role == 0 ? "Admin" : "Pengguna"; ?></td>
						<td>
							<button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#modalEdit<?php echo $v->id_pengguna; ?>">
								<i class="fas fa-pen"></i>
								Edit
							</button>
							<a href="<?php echo site_url('pengguna/delete/' . $v->id_pengguna); ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash" aria-hidden="true"></i> Hapus</a>
						</td>
					</tr>

					<!-- Modal Edit -->
					<div class="modal fade" id="modalEdit<?php echo $v->id_pengguna; ?>" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel<?php echo $v->id_pengguna; ?>" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="modalEditLabel<?php echo $v->id_pengguna; ?>">Edit pengguna</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<form action="<?php echo site_url('pengguna/update/' . $v->id_pengguna); ?>" method="POST">

									<div class="modal-body">
										<!-- Form Edit -->
										<div class="form-group">
											<label for="editNama">Nama pengguna</label>
											<input type="text" class="form-control" id="editNama" name="nama_pengguna" value="<?php echo $v->nama_pengguna; ?>" required>
										</div>
										<div class="form-group">
											<label for="editNama">Email</label>
											<input type="email" class="form-control" id="editEmail" name="email" value="<?php echo $v->email; ?>" required>
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
				<h5 class="modal-title" id="modalTambahLabel">Tambah pengguna</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="<?php echo site_url('pengguna/store'); ?>" method="POST">
				<div class="modal-body">
					<!-- Form Tambah -->
					<div class="form-group">
						<label for="tambahNama">Nama pengguna</label>
						<input type="text" class="form-control" id="tambahNama" name="nama_pengguna" required>
					</div>
					<div class="form-group">
						<label for="tambahNama">Email</label>
						<input type="email" class="form-control" id="tambahNama" name="email" required>
					</div>

					<div class="form-group">
						<label for="jurusan">Role</label>
						<select name="matkul_id" class="form-control" id="" required>
							<option selected disabled>Pilih Role</option>
							<option value="0">Admin</option>
							<option value="1">Pengguna</option>
						</select>
					</div>
					<div class="form-group">
						<label for="tambahPassword">Password</label>
						<input type="text" class="form-control" id="tambahPassword" name="password" required>
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
