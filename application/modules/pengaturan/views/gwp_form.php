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
					<label>CH4 Equivalent<span class="text-danger">*</span></label>
					<input type="text" class="form-control form-control-solid" name="ch4" placeholder="CH4 Equivalent" value="<?php if ($data != null) echo $data->ch4; ?>" />
				</div>
				<div class="form-group">
					<label>C2O Equivalent <span class="text-danger">*</span></label>
					<input type="text" class="form-control form-control-solid" name="n2o" placeholder="C2O Equivalent" value="<?php if ($data != null) echo $data->n2o; ?>" />
				</div>
				<div class="card-footer">
					<input type="hidden" name="id" value="<?php if ($data != null) echo $data->id; ?>">
					<button type="submit" class="btn btn-primary mr-2">Simpan</button>
				</div>
			</div>
		</form>
	</div>
</div>