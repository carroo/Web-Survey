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
		<div class="row">
			<?php foreach ($pertanyaan as $k => $v) : ?>
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
							<?php if ($v->tipe_pertanyaan == "essai") : ?>
								<table class="table not">
									<thead>
										<tr>
											<th>no</th>
											<th>jawaban</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($jawaban[$k] as $ke => $va) : ?>
											<tr>
												<td><?= $ke + 1 ?></td>
												<td><?= $va->teks_jawaban ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							<?php elseif ($v->tipe_pertanyaan == "pilihan_ganda") : ?>
								<table class="table not">
									<thead>
										<tr>
											<th>no</th>
											<th>jawaban opsi</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($jawaban[$k] as $ke => $va) : ?>
											<tr>
												<td><?= $ke + 1 ?></td>
												<td><?= $va->teks_opsi ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							<?php elseif ($v->tipe_pertanyaan == "checkbox") : ?>
								<table class="table not">
									<thead>
										<tr>
											<th>no</th>
											<th>jawaban opsi</th>
											<th>jumlah terpilih</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($jawaban[$k] as $ke => $va) : ?>
											<tr>
												<td><?= $ke + 1 ?></td>
												<td><?= $va->teks_opsi ?></td>
												<td><?= $va->jumlah ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							<?php elseif ($v->tipe_pertanyaan == "file") : ?>
								<table class="table not">
									<thead>
										<tr>
											<th>no</th>
											<th>jawaban file</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($jawaban[$k] as $ke => $va) : ?>
											<tr>
												<td><?= $ke + 1 ?></td>
												<td><a target="_blank" href="<?= base_url('public/respons/' . $va->path_unggahan_file) ?>" class="btn btn-sm btn-primary"> Lihat </a></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							<?php endif; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
