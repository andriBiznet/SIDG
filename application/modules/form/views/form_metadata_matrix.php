 <div class="card card-custom">
	<div class="card-header py-3">
		<div class="card-title align-items-start flex-column">
			<h3 class="card-label font-weight-bolder text-dark">METADATA</h3>
		</div>
		<!-- Button trigger modal-->
		<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambah-data">+ Tambah Data</button>
	</div>
	<div class="card-body" style="margin-top:-20px;">
		<!--begin: Datatable-->
		<div id="kt_datatable_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
			<div class="row">
				<div class="col-sm-12">
					<table class="table table-separate data table-head-custom table-checkable dataTable no-footer dtr-inline" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info" style="width: 975px;">
						<thead>
							<tr role="row">
								<th class="sorting_asc" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 144px;" aria-sort="ascending" aria-label="Agent: activate to sort column descending">ID</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 145px;" aria-label="Company Email: activate to sort column ascending">Tahun</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 145px;" aria-label="Company Email: activate to sort column ascending">Judul</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 145px;" aria-label="Company Email: activate to sort column ascending">Sumber Data</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 145px;" aria-label="Company Email: activate to sort column ascending">Keterangan</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 145px;" aria-label="Company Email: activate to sort column ascending">Nama Kontak</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 92px;" aria-label="Company Agent: activate to sort column ascending">No Hp Kontak</th>
								<th class="sorting" tabindex="0" aria-controls="kt_datatable" rowspan="1" colspan="1" style="width: 92px;" aria-label="Company Agent: activate to sort column ascending">Email Kontak</th>
								<th class="sorting_disabled" rowspan="1" colspan="1" style="width: 105px;" aria-label="Actions">Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$editin=1;
						foreach ($metadata_matrix->result() as $row): ?>
						<tr role="row" class="odd">
							<td><?php echo $row->id; ?></td>
							<td><?php echo $row->tahun; ?></td>
							<td><?php echo $row->judul; ?></td>
							<td><?php echo $row->sumber_data; ?></td>
							<td><?php echo $row->keterangan; ?></td>
							<td><?php echo $row->nama_kontak; ?></td>
							<td><?php echo $row->no_hp_kontak; ?></td>
							<td><?php echo $row->email_kontak; ?></td>
							<td nowrap="nowrap">	
								<button type="button" class="btn" data-toggle="modal" data-target="#myModal" data-tahun="<?php echo $row->tahun; ?>" data-judul="<?php echo $row->judul; ?>" data-sumber_data="<?php echo $row->sumber_data; ?>" data-keterangan="<?php echo $row->keterangan; ?>" data-nama_kontak="<?php echo $row->nama_kontak; ?>" data-no_hp_kontak="<?php echo $row->no_hp_kontak; ?>" data-email_kontak="<?php echo $row->email_kontak; ?>" data-eid="<?php echo $row->id; ?>" id="editid<?php echo $editin; ?>" onclick="edit_bil(<?php echo $editin; ?>)"><i class="la la-edit"></i></button>
								<a href="<?php echo base_url('form/form/hapus/'.$id_form.'/'.$row->id); ?>" class="btn btn-sm btn-clean btn-icon" title="Edit details">
									<i class="la la-trash"></i>
								</a>
							</td>
						</tr>
						<?php $editin++; endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" aria-hidden="true" id="tambah-data" tabindex="-1" role="dialog" aria-labelledby="ModelTambah" style="padding-right: 17px; display: none;" aria-modal="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ModelTambah">Tambah Metadata</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
             	<form class="form-horizontal" action="<?php echo base_url('form/form/tambah_matrix/'.$id_form.'/'.$tahun); ?>" method="post" enctype="multipart/form-data" role="form">
              		<div class="modal-body">
						<div class="form-group">
							<label>Judul <span class="text-danger">*</span></label>
							<input type="text" class="form-control form-control-solid" name="judul" placeholder="Judul"/>
						</div>
						<div class="form-group">
							<label>Sumber Data <span class="text-danger">*</span></label>
							<input type="text" class="form-control form-control-solid" name="sumber_data" placeholder="Sumber Data"/>
						</div>
						<div class="form-group">
							<label>Keterangan </label>
							<input type="text" class="form-control form-control-solid" name="keterangan" placeholder="Keterangan"/>
						</div>
						<div class="form-group">
							<label>Nama Kontak </label>
							<input type="text" class="form-control form-control-solid" name="nama_kontak" placeholder="Nama Kontak"/>
						</div>
						<div class="form-group">
							<label>No HP Kontak </label>
							<input type="text" class="form-control form-control-solid" name="no_hp_kontak" placeholder="No HP Kontak"/>
						</div>
						<div class="form-group">
							<label>Email Kontak </label>
							<input type="email" class="form-control form-control-solid" name="email_kontak" placeholder="Email Kontak"/>
						</div>
                  	</div>
                  	<div class="modal-footer">
                      	<button class="btn btn-primary" type="submit"> Simpan&nbsp;</button>
                      	<button type="button" class="btn btn-light" data-dismiss="modal"> Batal</button>
                 	</div>
                </form>
            </div>
        </div>
    </div>

	<div role="dialog" class="modal fade" aria-hidden="true" id="myModal" tabindex="-1" role="dialog" aria-labelledby="ModelLabelEdit" style="padding-right: 17px; display: none;" aria-modal="true">
	    <div class="modal-dialog" role="document">
	        <div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="ModelLabelEdit">Edit Metadata</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<i aria-hidden="true" class="ki ki-close"></i>
					</button>
				</div>
             	<form class="form-horizontal" action="<?php echo base_url('form/form/ubah_matrix/'.$id_form); ?>" method="post" enctype="multipart/form-data" role="form">
              		<div class="modal-body">
						<input type="hidden" name="eid" id="eid">
						<div class="form-group">
							<label>Tahun</label>
							<input type="text" id="tahun" class="form-control form-control-solid" name="tahun" placeholder="Tahun"/>
						</div>
						<div class="form-group">
							<label>Judul <span class="text-danger">*</span></label>
							<input type="text" id="judul" class="form-control form-control-solid" name="judul" placeholder="Judul"/>
						</div>
						<div class="form-group">
							<label>Sumber Data <span class="text-danger">*</span></label>
							<input type="text" id="sumber_data" class="form-control form-control-solid" name="sumber_data" placeholder="Sumber Data"/>
						</div>
						<div class="form-group">
							<label>Keterangan</label>
							<input type="text" id="keterangan" class="form-control form-control-solid" name="keterangan" placeholder="Keterangan"/>
						</div>
						<div class="form-group">
							<label>Nama Kontak</label>
							<input type="text" id="nama_kontak" class="form-control form-control-solid" name="nama_kontak" placeholder="Nama Kontak"/>
						</div>
						<div class="form-group">
							<label>No HP Kontak</label>
							<input type="text" id="no_hp_kontak" class="form-control form-control-solid" name="no_hp_kontak" placeholder="No HP Kontak"/>
						</div>
						<div class="form-group">
							<label>Email Kontak</label>
							<input type="email" id="email_kontak" class="form-control form-control-solid" name="email_kontak" placeholder="Email Kontak"/>
						</div>
                  	</div>
                  	<div class="modal-footer">
                      	<button class="btn btn-primary" type="submit"> Simpan&nbsp;</button>
                      	<button type="button" class="btn btn-light" data-dismiss="modal"> Batal</button>
                 	</div>
                </form>
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
	function edit_bil(id){
		var eid=$('#editid'+id).data('eid');
		document.getElementById('eid').value=eid;
		var tahun=$('#editid'+id).data('tahun');
		document.getElementById('tahun').value=tahun;
		var judul=$('#editid'+id).data('judul');
		document.getElementById('judul').value=judul;
		var sumber_data=$('#editid'+id).data('sumber_data');
		document.getElementById('sumber_data').value=sumber_data;
		var keterangan=$('#editid'+id).data('keterangan');
		document.getElementById('keterangan').value=keterangan;
		var nama_kontak=$('#editid'+id).data('nama_kontak');
		document.getElementById('nama_kontak').value=nama_kontak;
		var no_hp_kontak=$('#editid'+id).data('no_hp_kontak');
		document.getElementById('no_hp_kontak').value=no_hp_kontak;
		var email_kontak=$('#editid'+id).data('email_kontak');
		document.getElementById('email_kontak').value=email_kontak;
	}
	$(document).ready(function(){
		$('.data').DataTable({
	        "scrollY": 200,
	        "scrollX": true
		});
	});
</script>