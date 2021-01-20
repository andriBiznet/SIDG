<!DOCTYPE html>
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../../">
		<meta charset="utf-8" />
		<title>SIGD DKI Jakarta | Sistem Informasi Gas Rumah Kaca Daerah</title>
		<meta name="description" content="Login page example" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
		<!--begin::Fonts-->
		<link href="https://fonts.googleapis.com/css2?family=Mukta:wght@300;400;500;600;700&display=swap" rel="stylesheet"> 
		<!--end::Fonts-->
		<!--begin::Page Custom Styles(used by this page)-->
		<link href="<?php echo base_url('/assets/metronic/'); ?>assets/css/pages/login/classic/login-6.css" rel="stylesheet" type="text/css" />
		<!--end::Page Custom Styles-->
		<!--begin::Global Theme Styles(used by all pages)-->
		<link href="<?php echo base_url('/assets/metronic/'); ?>assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('/assets/metronic/'); ?>assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('/assets/metronic/'); ?>assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<!--end::Global Theme Styles-->
		<!--begin::Layout Themes(used by all pages)-->
		<link href="<?php echo base_url('/assets/metronic/'); ?>assets/css/themes/layout/header/base/light.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('/assets/metronic/'); ?>assets/css/themes/layout/header/menu/light.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('/assets/metronic/'); ?>assets/css/themes/layout/brand/dark.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url('/assets/metronic/'); ?>assets/css/themes/layout/aside/dark.css" rel="stylesheet" type="text/css" />
		<!--end::Layout Themes-->
		<link rel="shortcut icon" href="<?php echo base_url('/assets/metronic/'); ?>assets/media/logos/favicon.png" />
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
		<!--begin::Main-->
		<div class="d-flex flex-column flex-root">
			<!--begin::Login-->
			<div class="login login-6 login-signin-on login-signin-on d-flex flex-column-fluid" id="kt_login">
				<div class="d-flex flex-column flex-lg-row flex-row-fluid text-center" style="background-image: url(<?php echo base_url('/assets/metronic/'); ?>assets/media/bg/bg-3.jpg);">
					<!--begin:Aside-->
					<div class="d-flex w-100 flex-center p-15">
						<div class="login-wrapper">
							<!--begin:Aside Content-->
							<div class="text-dark-75">
								<a href="#">
									<img src="<?php echo base_url('/assets/metronic/'); ?>assets/media/logos/logo-dlh.jpg" width="120" alt="" />
								</a>
								<h3 class="mb-8 mt-22 font-weight-bold">SISTEM INVENTARISASI<br>GAS RUMAH KACA DAERAH<br>DKI JAKARTA</h3>
								<p class="mb-15 text-muted font-weight-bold"></p>
							</div>
							<!--end:Aside Content-->
						</div>
					</div>
					<!--end:Aside-->
					<!--begin:Divider-->
					<div class="login-divider">
						<div></div>
					</div>
					<!--end:Divider-->
					<!--begin:Content-->
					<div class="d-flex w-100 flex-center p-15 position-relative overflow-hidden">
						<div class="login-wrapper">
							<!--begin:Sign In Form-->
							<div class="login-signin">
								<div class="text-center mb-10 mb-lg-20">
									<h2 class="font-weight-bold">Login SIGD</h2>
									<p class="text-muted font-weight-bold">Mohon masukkan Username dan Password</p>
								</div>
								
								<?php if ($this->session->flashdata('login_status') == 'err'): ?>
								<div class="alert alert-danger">
									Login gagal! Silakan coba lagi.
								</div>
								<?php endif; ?>
								
								<form class="form text-left" id="kt_login_signin_form" method="post" action="<?php echo site_url('/site/login'); ?>">
									<div class="form-group py-2 m-0">
										<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="text" placeholder="Username" name="username" autocomplete="off" />
									</div>
									<div class="form-group py-2 border-top m-0">
										<input class="form-control h-auto border-0 px-0 placeholder-dark-75" type="Password" placeholder="Password" name="password" />
									</div>
									<div class="text-center mt-15">
										<button id="kt_login_signin_submit" class="btn btn-primary btn-pill shadow-sm py-4 px-9">LOGIN SEKARANG</button>
									</div>
								</form>
							</div>
							<!--end:Sign In Form-->
						</div>
					</div>
					<!--end:Content-->
				</div>
			</div>
			<!--end::Login-->
		</div>
		<!--end::Main-->
		<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
		<!--begin::Global Config(global config for global JS scripts)-->
		<script>var KTAppSettings = { "breakpoints": { "sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400 }, "colors": { "theme": { "base": { "white": "#ffffff", "primary": "#3699FF", "secondary": "#E5EAEE", "success": "#1BC5BD", "info": "#8950FC", "warning": "#FFA800", "danger": "#F64E60", "light": "#E4E6EF", "dark": "#181C32" }, "light": { "white": "#ffffff", "primary": "#E1F0FF", "secondary": "#EBEDF3", "success": "#C9F7F5", "info": "#EEE5FF", "warning": "#FFF4DE", "danger": "#FFE2E5", "light": "#F3F6F9", "dark": "#D6D6E0" }, "inverse": { "white": "#ffffff", "primary": "#ffffff", "secondary": "#3F4254", "success": "#ffffff", "info": "#ffffff", "warning": "#ffffff", "danger": "#ffffff", "light": "#464E5F", "dark": "#ffffff" } }, "gray": { "gray-100": "#F3F6F9", "gray-200": "#EBEDF3", "gray-300": "#E4E6EF", "gray-400": "#D1D3E0", "gray-500": "#B5B5C3", "gray-600": "#7E8299", "gray-700": "#5E6278", "gray-800": "#3F4254", "gray-900": "#181C32" } }, "font-family": "Poppins" };</script>
		<!--end::Global Config-->
		<!--begin::Global Theme Bundle(used by all pages)-->
		<script src="<?php echo base_url('/assets/metronic/'); ?>assets/plugins/global/plugins.bundle.js"></script>
		<script src="<?php echo base_url('/assets/metronic/'); ?>assets/plugins/custom/prismjs/prismjs.bundle.js"></script>
		<script src="<?php echo base_url('/assets/metronic/'); ?>assets/js/scripts.bundle.js"></script>
		<!--end::Global Theme Bundle-->
		<!--begin::Page Scripts(used by this page)-->
		<script src="<?php echo base_url('/assets/metronic/'); ?>assets/js/pages/custom/login/login-general.js"></script>
		<!--end::Page Scripts-->
	</body>
	<!--end::Body-->
</html>