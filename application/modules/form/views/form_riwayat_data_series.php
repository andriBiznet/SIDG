<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

 <div class="card card-custom">
	<div class="card-header py-3">
		<div class="card-title align-items-start flex-column">
			<h3 class="card-label font-weight-bolder text-dark">Riwayat Data</h3>
			<!-- <span class="text-muted font-weight-bold font-size-sm mt-1">Change your account password</span> -->
		</div>
	</div>
	<div class="card-body">
		<!--begin: Datatable-->
		<div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-separate data_riwayat_series table-head-custom table-checkable dataTable no-footer dtr-inline" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 975px;">
						<thead>
							<tr role="row">
								<th class="sorting_desc" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 144px;" aria-sort="descending" aria-label="Agent: activate to sort column descending">ID</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 145px;" aria-label="Company Email: activate to sort column descending">Tahun</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 145px;" aria-label="Company Email: activate to sort column descending">Pengukuran</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 145px;" aria-label="Company Email: activate to sort column descending">Nilai Sebelumnya</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 145px;" aria-label="Company Email: activate to sort column descending">Nilai Baru</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 145px;" aria-label="Company Email: activate to sort column descending">Tanggal</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 92px;" aria-label="Company Agent: activate to sort column descending">Nama</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($dataa->result() as $row): ?>
						<tr role="row" class="odd">
							<td><?php echo $row->id; ?></td>
							<td><?php echo $row->tahun; ?></td>
							<td><?php echo $row->teks; ?></td>
							<td style="text-align: right;"><?php echo number_format($row->nilai_sebelumnya); ?></td>
							<td style="text-align: right;"><?php echo number_format($row->nilai_baru); ?></td>
							<td><?php echo $row->created_at; ?></td>
							<td><?php echo $row->pengguna_grup; ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.data_riwayat_series').DataTable({
        "scrollY": 200,
        "order": [[ 0, "desc" ]],
        "scrollX": true
		});
	});
</script>