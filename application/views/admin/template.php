<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="<?= base_url('uploads/logo/unu1.png') ?>" />

	<title><?= $title; ?></title>
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
	<link href="<?= base_url(); ?>assets/css/app.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
</head>

<body>
	<script type="text/javascript">
		var BASE_URL = "<?= base_url(); ?>";
	</script>
	<script src="<?= base_url() ?>assets/plugins/jquery/dist/jquery.min.js"></script>
	<div class="wrapper">
		<?php $this->load->view('admin/include/sidebar') ?>

		<div class="main">
			<?php $this->load->view('admin/include/navbar') ?>

			<?php $this->load->view($page) ?>
			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-6 text-start">
							<b class="mb-0">
								FULLOBSTER SURABAYA
							</b>
						</div>
						<div class="col-6 text-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									FULLOBSTER - 2022
								</li>
							</ul>
						</div>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<script src="<?= base_url() ?>assets/js/app.js"></script>
	<link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
	<!-- SweetAlert2 -->
	<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
</body>

</html>