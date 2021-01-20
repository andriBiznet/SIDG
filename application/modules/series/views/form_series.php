<div class="row mb-3">
	<div class="col-md-6">
		<button class="btn btn-sm btn-primary" onclick="series.submit()">
			<i class="ti ti-save"></i> SIMPAN DATA
		</button>
	</div>
	<div class="col-md-6">
		<button class="btn btn-sm btn-light-info float-right ml-2"><i class="ti ti-harddrives"></i> Riwayat Data</button>
		<button class="btn btn-sm btn-light-info float-right"><i class="ti ti-comment-alt"></i> Metadata</button>
	</div>
</div>

<div class="table-responsive">
	<form method="post" action="<?php echo site_url('/form/save_series/'.$id_form); ?>" id="series">
	<table class="table table-sm table-sheet table-bordered" id="kt_datatable">
		<thead>
			<tr>
				<th>TAHUN</th>
				<?php foreach ($cols->result() as $col): ?>
				<th><?php echo $col->teks; ?><br>(<?php echo $col->kode_satuan; ?>)</th>
				<?php endforeach; ?>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($data as $tahun => $isi): ?>
			<tr>
				<td><?php echo $tahun; ?></td>
				<?php foreach ($isi as $id_pengukuran => $nilai): ?>
				<td>
					<input type="hidden" name="current[<?php echo $tahun; ?>][<?php echo $id_pengukuran; ?>]" value="<?php echo $nilai; ?>">
					<input type="text" class="int" name="new[<?php echo $tahun; ?>][<?php echo $id_pengukuran; ?>]" value="<?php echo $nilai; ?>">
				</td>
				<?php endforeach; ?>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	</form>
</div>