<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<div class="card card-custom">
	<div class="card-body">
		<!--begin: Datatable-->
		<div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
			<div class="row">
				<div class="col-sm-12">
					<form method="post" action="<?php echo $action; ?>">
						<?php if ($this->session->flashdata('save_status') == 'err'): ?>
						<div class="alert alert-danger mb-10">
							<?php echo $this->session->flashdata('save_message'); ?>
						</div>
						<?php endif; ?>
						<table class="table table-separate data table-head-custom table-checkable dataTable no-footer dtr-inline" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 975px;">
							<thead>
								<tr role="row">
									<th class="sorting_asc" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 144px;" aria-sort="ascending" aria-label="Agent: activate to sort column descending">ID</th>
									<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 92px;" aria-label="Company Agent: activate to sort column ascending">Nama</th>
									<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 92px;" aria-label="Company Agent: activate to sort column ascending">Satuan</th>
									<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 92px;" aria-label="Company Agent: activate to sort column ascending">Nilai Default</th>
									<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 92px;" aria-label="Company Agent: activate to sort column ascending">Nilai</th>
									<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 92px;" aria-label="Company Agent: activate to sort column ascending">Keterangan</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data->result() as $row): ?>
								<tr role="row" class="odd">
									<td><?php echo $row->id; ?></td>
									<td><?php echo $row->nama; ?></td>
									<td><?php echo $row->satuan; ?></td>
									<td><?php echo $row->nilai_default; ?></td>
									<td>
										<input type="text" class="form-control form-control-solid" name="nilai[]" placeholder="Nilai" value="<?php if ($row != null) echo $row->nilai; ?>" />
									</td>
									<td>
										<input type="text" class="form-control form-control-solid" name="keterangan[]" placeholder="Keterangan" value="<?php if ($row != null) echo $row->keterangan; ?>" />
									</td>
								</tr>

								<input type="hidden" name="id[]" value="<?php if ($row != null) echo $row->id; ?>">
								<?php endforeach; ?>
							</tbody>
						</table>
						<div class="card-footer">
							<button type="submit" class="btn btn-primary mr-2">Simpan</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable({
	        "scrollY": 350,
	        "scrollX": true
		});
	});
</script>