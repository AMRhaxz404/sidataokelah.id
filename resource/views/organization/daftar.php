<div class="home-body">
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
						<li><a href="<?= url('daftar_event') ?>">Daftar Event</a></li>
					</ul>
				</div>
			</div>
		</div>
	</nav>

	<div class="main main-home">
		<div class="container-fluid">
			<div class="row">
				<div class="welcome-text col-md-offset-1 col-md-6 col-lg-offset-2 col-lg-5">
					<div class="welcome-text-1">Selamat datang</div>
					<div class="welcome-text-2">
						SIDATA OKELAH adalah platform terintegrasi yang ditujukan bagi pengelola organisasi di lingkungan Dinas Pendidikan Pemuda dan Olahraga Kabupaten Teluk Wondama untuk mengelola pendaftaran kegiatan organisasi. SIDATA OKELAH menggunakan E-OKP berbasis NFC sehingga proses pendaftaran menjadi lebih mudah, cepat, dan akurat.
					</div>
				</div>
				<div class="login-form col-md-4 col-lg-3">
					<form method="POST" action="<?= url('register') ?>" enctype="multipart/form-data">
						<label>Daftar</label>
						<div class="clear"></div>
						
						<div class="msg-name daftar-msg"></div>
						<input class="validate-name" type="text" name="name" placeholder="Nama Organisasi" required pattern=".{1,60}" title="Nama Organisasi Maksimum 60 Karakter"/>

						<input type="text" name="nim" placeholder="NIP/NIM Penanggung Jawab" required pattern=".{9,18}" title="Mohon masukkan NIP / NIM yang valid" />
						<input type="number" name="phone" placeholder="Nomor Telepon" required />
						<input type="email" name="email" placeholder="Email" required />

						<div class="msg-username daftar-msg"></div>
						<input class="validate-username" type="text" name="username" placeholder="Username" required pattern=".{1,40}" title="Username Maksimum 40 Karakter" />
						

						<input type="password" name="password" placeholder="Password" required />

						<div class="msg-password daftar-msg"></div>
						<input class="validate-password" type="password" name="validate" placeholder="Ulangi Password" required />

						<div class="daftar-berkas">Upload berkas organisasi</div>
						<input type="file" name="berkas" accept="application/pdf" required>
						<input type="submit" class="main-button daftar-button" id="submit" value="Daftar">
						<p class="already">Sudah memiliki akun? <a href="<?= url('') ?>">Login</a></p>
					</form>
				</div>
			</div>
		</div>
	</div>