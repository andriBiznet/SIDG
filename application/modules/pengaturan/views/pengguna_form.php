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
					<label>Nama Lengkap <span class="text-danger">*</span></label>
					<input type="text" class="form-control form-control-solid" name="nama" placeholder="Nama Lengkap" value="<?php if ($data != null) echo $data->nama; ?>" />
				</div>
				<div class="form-group">
					<label>Username <span class="text-danger">*</span></label>
					<input type="text" class="form-control form-control-solid" name="username" placeholder="Username" value="<?php if ($data != null) echo $data->username; ?>" />
				</div>
				<div class="form-group">
					<label>Password <?php if ($data == null): ?><span class="text-danger">*</span><?php endif; ?></label>
					<input type="text" class="form-control form-control-solid" name="password" placeholder="<?php echo $data == null ? 'Password' : 'Isi hanya jika mengubah password' ?>" />
				</div>
				<div class="form-group">
					<label>Instansi <span class="text-danger">*</span></label>
					<select class="form-control form-control-solid" name="id_instansi">
						<option value="">- Pilih Instansi -</option>
						<?php echo modules::run('options/instansi', $data != null ? $data->id_instansi : ''); ?>
					</select>
				</div>
				<div class="form-group">
					<label>Grup Pengguna <span class="text-danger">*</span></label>
					<select class="form-control form-control-solid" name="id_pengguna_grup">
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
	</div>
</div>