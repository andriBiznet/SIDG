<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
	<!--begin::Subheader-->
	<div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader">
		<div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
			<!--begin::Info-->
			<div class="d-flex align-items-center flex-wrap mr-1">
				<!--begin::Mobile Toggle-->
				<button class="burger-icon burger-icon-left mr-4 d-inline-block d-lg-none" id="kt_subheader_mobile_toggle">
					<span></span>
				</button>
				<!--end::Mobile Toggle-->
				<!--begin::Page Heading-->
				<div class="d-flex align-items-baseline flex-wrap mr-5">
					<!--begin::Page Title-->
					<h5 class="text-dark font-weight-bold my-1 mr-5">Profil Saya</h5>
					<!--end::Page Title-->
				</div>
				<!--end::Page Heading-->
			</div>
			<!--end::Info-->
			<!--begin::Toolbar-->
			<div class="d-flex align-items-center">
				<!--begin::Actions-->
				<!--end::Actions-->
				<!--begin::Dropdown-->
				<!--end::Dropdown-->
			</div>
			<!--end::Toolbar-->
		</div>
	</div>
	<!--end::Subheader-->
	<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<!--begin::Profile Personal Information-->
			<div class="d-flex flex-row">
				<!--begin::Aside-->
				<div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
					<!--begin::Profile Card-->
					<div class="card card-custom card-stretch">
						<!--begin::Body-->
						<div class="card-body pt-4">
							<!--begin::User-->
							<div class="d-flex align-items-center">
								<div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
									<div class="symbol-label"><img style="width: 60px" src="<?php echo base_url('assets/metronic/assets/media/users/avatar.png') ?>"></div>
									<i class="symbol-badge bg-success"></i>
								</div>
								<div>
									<a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary"><?php echo pengguna_session('nama'); ?></a>
								</div>
							</div>
							<!--end::User-->
							<!--begin::Contact-->
							<div class="py-9">
								<div class="d-flex align-items-center justify-content-between mb-2">
									<span class="font-weight-bold mr-2">Username:</span>
									<a href="#" class="text-muted text-hover-primary"><?php echo pengguna_session('username'); ?></a>
								</div>
								<div class="d-flex align-items-center justify-content-between mb-2">
									<span class="font-weight-bold mr-2">Instansi:</span>
									<a href="#" class="text-muted text-hover-primary" style="text-align: right;"><?php echo pengguna_session('instansi') ?></a>
								</div>
							</div>
							<!--end::Contact-->
							<!--begin::Nav-->
							<div class="navi navi-bold navi-hover navi-active navi-link-rounded">
								<div class="navi-item mb-2">
									<a href="<?php echo site_url('/site/profile'); ?>" class="navi-link py-4 active">
										<span class="navi-icon mr-2">
											<span class="svg-icon">
												<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/General/User.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<polygon points="0 0 24 0 24 24 0 24"></polygon>
														<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
														<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero"></path>
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>
										</span>
										<span class="navi-text font-size-lg">Profil Saya</span>
									</a>
								</div>
								<div class="navi-item mb-2">
									<a href="<?php echo site_url('/site/password'); ?>" class="navi-link py-4">
										<span class="navi-icon mr-2">
											<span class="svg-icon">
												<!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Shield-user.svg-->
												<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24"></rect>
														<path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3"></path>
														<path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3"></path>
														<path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3"></path>
													</g>
												</svg>
												<!--end::Svg Icon-->
											</span>
										</span>
										<span class="navi-text font-size-lg">Ubah Password</span>
									</a>
								</div>
							</div>
							<!--end::Nav-->
						</div>
						<!--end::Body-->
					</div>
					<!--end::Profile Card-->
				</div>
				<!--end::Aside-->
				<!--begin::Content-->
				<div class="flex-row-fluid ml-lg-8">
					<!--begin::Card-->
					<div class="card card-custom">
						<!--begin::Header-->
						<div class="card-header py-3">
							<div class="card-title align-items-start flex-column">
								<h3 class="card-label font-weight-bolder text-dark">Profil Saya</h3>
								<!-- <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account password</span> -->
							</div>
						</div>
						<!--end::Header-->
						<!--begin::Form-->
						<form method="post" action="<?php echo $action; ?>">
						<div class="card card-custom gutter-b">
							<div class="card-body">
								<?php if ($this->session->flashdata('save_status') == 'err'): ?>
								<div class="alert alert-danger mb-10">
									<?php echo $this->session->flashdata('save_message'); ?>
								</div>
								<?php endif; ?>
								<div class="form-group">
									<label>Nama Lengkap <span class="text-danger">*</span></label>
									<input type="text" class="form-control form-control-solid" name="nama" placeholder="Nama Lengkap" value="<?php if ($data != null) echo $data->nama; ?>" />
								</div>
								<div class="form-group">
									<label>Username <span class="text-danger">*</span></label>
									<input type="text" class="form-control form-control-solid" name="username" placeholder="Username" value="<?php if ($data != null) echo $data->username; ?>" />
								</div>
								<div class="form-group">
									<label>Instansi <span class="text-danger">*</span></label>
									<select class="form-control form-control-solid" disabled name="id_instansi">
										<option value="">- Pilih Instansi -</option>
										<?php echo modules::run('options/instansi', $data != null ? $data->id_instansi : ''); ?>
									</select>
								</div>
								<div class="form-group">
									<label>Grup Pengguna <span class="text-danger">*</span></label>
									<select class="form-control form-control-solid" disabled name="id_pengguna_grup">
										<option value="">- Pilih Grup Pengguna -</option>
										<?php echo modules::run('options/pengguna_grup', $data != null ? $data->id_pengguna_grup : ''); ?>
									</select>
								</div>
							</div>
							<div class="card-footer">
								<input type="hidden" name="id" value="<?php if ($data != null) echo $data->id; ?>">
								<button type="submit" class="btn btn-primary mr-2">Simpan</button>
							</div>
						</div>
						</form>
						<!--end::Form-->

					</div>
				</div>
				<!--end::Content-->
			</div>
			<!--end::Profile Personal Information-->
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
</div>