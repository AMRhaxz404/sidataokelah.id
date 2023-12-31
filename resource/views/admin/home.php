	<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
					<div class="navbar-header">
						<a class="navbar-brand" href="<?= url('') ?>">
							<img src="<?= url('resource/assets/images/logo.png') ?>">
							<span class="logo-text">SIDATA OKELAH</span>
						</a>
					</div>
					<ul class="nav navbar-nav navbar-right">
						<li><a href="<?= url('home') ?>">Daftar Organisasi</a></li>
						<li><a href="<?= url('logout') ?>">Logout</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>

	<div class="main grey">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-offset-1 col-md-5 col-lg-offset-2 col-lg-4 section-title">
					Daftar Organisasi
				</div>
				<div class="col-md-5 col-lg-4 top-button">
					<a href="<?= url('persetujuan_event') ?>"><button class="button button-green button-right">Persetujuan Event</button></a>
					<a href="<?= url('persetujuan_organisasi') ?>"><button class="button button-green button-left">Persetujuan Organisasi</button></a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8 panel panel-default content">

					<?php if(empty($organizations)): ?>

						<div class="main-box add-reg">
							<p class="main-message">Tidak ada organisasi yang terdaftar.</p>
						</div>

					<?php else: ?>

						<table class="table table-hover main-table">
							<thead>
								<tr>
									<th class="col-md-1">No.</th>
									<th class="col-md-6">Nama Organisasi</th>
									<th class="col-md-4">Aksi</th>
								</tr>
							</thead>
							<tbody>

								<?php $i = 1; foreach ($organizations as $organization): ?>

								<tr>
									<td><?= $i ?></td>
									<td><?= $organization->name ?></td>
									<td>
										<a href="<?= url('detail_organisasi/'.Security::encrypt($organization->id)) ?>"><button class="button-small button-green">Detail</button></a>
										<a href="<?= url('lihat_organisasi/'.Security::encrypt($organization->id)) ?>"><button class="button-small button-blue">Daftar Event</button></a>
										<a href="<?= url(' hapus_organisasi/'.$organization->id.'/0') ?>" onclick="return confirm('Yakin ingin menghapus?')"><button class="button-small button-red">Hapus</button></a>
									</td>
								</tr>

								<?php $i++; endforeach; ?>


							</tbody>
						</table>

					<?php endif; ?>

					
				</div>
			</div>
		</div>
	</div>