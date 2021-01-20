<div class="row mb-3">
	<div class="col-md-6">
		<button class="btn btn-sm btn-primary" onclick="series.submit()">
			<i class="ti ti-save"></i> SIMPAN DATA
		</button>
		<a href="<?php echo site_url('/form/export/export_data_series/'.$id_form); ?>"> 
			<button class="btn btn-sm btn-primary">
				<i class="ti ti-save"></i> Export Data
			</button>
		</a>
		<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#import-data">
			<i class="ti ti-cloud-up"></i> Impor Data
		</button>
	</div>
</div>	

<div class="table-responsive">
	<form method="post" action="<?php echo site_url('/series/save/'.$id_form); ?>" id="series">
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

	<div class="modal fade" aria-hidden="true" id="import-data" tabindex="-1" role="dialog" aria-labelledby="ModelTambah" style="padding-right: 17px; display: none;" aria-modal="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ModelTambah">Import Data Series</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
				<form method="post" action="<?php echo site_url('/impor/impor/upload/'.$id_form); ?>" enctype="multipart/form-data">
					<div class="modal-body">
						<input type="file" name="userfile">
						<input type="submit" value="Upload">
					</div>
				</form>
            </div>
        </div>
    </div>