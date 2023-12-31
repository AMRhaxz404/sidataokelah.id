
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
						<br />
						<a class="link-download" href="<?= $GLOBALS['assets'].'/file/app.apk'?>"><button class="button button-download button-blue">Download Aplikasi Scanner</button></a>
					</div>
				</div>
				<div class="login-form col-md-4 col-lg-3">
					<form method="POST" action="<?= url('login') ?>">
						<label>Login</label>
						<div class="clear"></div>
						<?= (isset($msg)) ? '<div class="alert alert-danger">' . $msg . '</div>' : null; ?>
						<input type="text" name="username" placeholder="Username" />
						<input type="password" name="password" placeholder="Password">
						<button class="main-button">Login</button>
						<p class="already">Belum memiliki akun? <a href="<?= url('daftar') ?>">Daftar</a></p>
					</form>
				</div>
			</div>
		</div>
	</div>