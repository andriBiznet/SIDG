<div class="d-flex flex-row">
	<div class="flex-row-auto offcanvas-mobile w-300px w-xl-350px" id="kt_profile_aside">
		<!--begin::Card-->
		<div class="card card-custom gutter-b"> 	
			<div class="card-header py-3">
				<div class="card-title align-items-start flex-column">
					<span class="navi-icon mr-2">
					<span class="navi-text">Ubah Pengguna Grup</span>
				</div>
			</div>
			<form method="post" action="<?php echo $action; ?>">
				<div class="card-body">
					<?php if ($this->session->flashdata('save_status') == 'err'): ?>
					<div class="alert alert-danger mb-10">
						<?php echo $this->session->flashdata('save_message'); ?>
					</div>
					<?php endif; ?>
					
					<div class="form-group">
						<label>Nama <span class="text-danger">*</span></label>
						<input type="text" class="form-control form-control-solid" name="nama" placeholder="Nama" value="<?php if ($data != null) echo $data->nama; ?>" />
					</div>
					<div class="form-group">
						<label>Urutan<span class="text-danger">*</span></label>
						<input type="text" class="form-control form-control-solid" name="urutan" placeholder="Urutan" value="<?php if ($data != null) echo $data->urutan; ?>" />
					</div>
				</div>
				<div class="card-footer">
					<input type="hidden" name="id" value="<?php if ($data != null) echo $data->id; ?>">
					<button type="submit" class="btn btn-primary mr-2">Simpan</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
$().ready(function() {
	
	$('[name=grant_all]').click(function() {
		var is_checked = $(this).is(':checked');
		$('.read-access').each(function() { $(this).prop('checked', is_checked); });
	});
	
});
</script>