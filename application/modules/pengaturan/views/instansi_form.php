<div class="row">
	<div class="col-md-6">
		<form method="post" action="<?php echo $action; ?>">
		<div class="card card-custom gutter-b">
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
					<label>Alias<span class="text-danger">*</span></label>
					<input type="text" class="form-control form-control-solid" name="alias" placeholder="Alias" value="<?php if ($data != null) echo $data->alias; ?>" />
				</div>
			</div>
			<div class="card-footer">
				<input type="hidden" name="id" value="<?php if ($data != null) echo $data->id; ?>">
				<button type="submit" class="btn btn-primary mr-2">Simpan</button>
			</div>
		</div>
		</form>
	</div>
</div>