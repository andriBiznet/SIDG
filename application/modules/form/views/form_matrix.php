<div class="row mb-3">
	<div class="col-md-6">
		<button class="btn btn-sm btn-primary" onclick="matrix.submit()"><i class="ti ti-save"></i> SIMPAN DATA</button>
		<a href="<?php echo site_url('/form/export/export_data_matrix/'.$id_form.'/'.$tahun); ?>"> <button class="btn btn-sm btn-primary">
			<i class="ti ti-save"></i> Export Data
		</button></a>
	</div>
</div>

<div class="row mb-3">
	<div class="col-md-6">
		<div class="btn-group mr-1">
			<button type="button" class="btn btn-sm btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Tahun Inventori: <b><?php echo $tahun; ?></b>
			</button>
			<div class="dropdown-menu inv-year">
				<?php for ($i = '2010'; $i <= date('Y'); $i++): ?>
				<a class="dropdown-item" href="<?php echo site_url('/form/'.$id_form.'/'.$i); ?>"><?php echo $i; ?></a>
				<?php endfor; ?>
			</div>
		</div>
	</div>
</div>

<div class="table-responsive">
	<form method="post" action="<?php echo site_url('/matrix/save/'.$id_form.'/'.$tahun); ?>" id="matrix">
	<table class="table table-sm table-sheet table-bordered" id="kt_datatable">
		<thead>
			<tr>
				<th>NO.</th>
				<th>UNIT</th>
				<?php foreach ($cols->result() as $col): ?>
				<th><?php echo $col->teks; ?><br>(<?php echo $col->kode_satuan; ?>)</th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; ?>
			<?php foreach ($data as $unit => $sub): ?>
			<tr>
				<td class="text-left"><?php echo $no++; ?>.</td>
				<td class="text-left"><?php echo $unit; ?></td>
				<?php foreach ($sub as $id_pengukuran => $isi): ?>
				<td>
					<input type="hidden" name="current[<?php echo $isi['id_unit']; ?>][<?php echo $id_pengukuran; ?>]" value="<?php echo $isi['nilai']; ?>">
					<input type="text" class="int" name="new[<?php echo $isi['id_unit']; ?>][<?php echo $id_pengukuran; ?>]" value="<?php echo $isi['nilai']; ?>">
				</td>
				<?php endforeach; ?>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	</form>
</div>