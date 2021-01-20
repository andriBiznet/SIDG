<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

 <div class="card card-custom">
	<div class="card-body">
		<!--begin: Datatable-->
		<div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-separate data table-head-custom table-checkable dataTable no-footer dtr-inline" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 975px;">
						<thead>
							<tr role="row">
								<th class="sorting_asc" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 144px;" aria-sort="ascending" aria-label="Agent: activate to sort column descending">ID</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 145px;" aria-label="Company Email: activate to sort column ascending">Nama</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 92px;" aria-label="Company Agent: activate to sort column ascending">Username</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 141px;" aria-label="Company Name: activate to sort column ascending">Instansi</th>
								<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 105px;" aria-label="Actions">Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($data->result() as $row): ?>
							<tr role="row" class="odd">
								<td><?php echo $row->id; ?></td>
								<td><?php echo $row->nama; ?></td>
								<td><?php echo $row->username; ?></td>
								<td><?php echo $row->instansi; ?></td>
								<td nowrap="nowrap">	
									<a href="<?php echo site_url('/pengaturan/pengguna/ubah/'.$row->id); ?>" class="btn btn-sm btn-clean btn-icon" title="Edit details">
										<i class="la la-edit"></i>
									</a><?php if ($row->id > 1): ?>
									<a href="<?php echo base_url('pengaturan/pengguna/hapus/'.$row->id); ?>" class="btn btn-sm btn-clean btn-icon" title="Edit details">
										<i class="la la-trash"></i>
									</a><?php endif; ?>
								</td>
							</tr>
							<?php endforeach; ?>
						</tbody>
					</table>
				</div>	
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable();
	});
</script>