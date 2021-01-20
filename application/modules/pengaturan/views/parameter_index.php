<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<div class="d-flex flex-row">
	<div class="col-md-12">
		<div class="card card-custom gutter-b">
			<div class="card-body">
				<div class="row mb-3">
					<div class="col-md-6">
						<select class="form-control form-control-solid" name="sektor">
							<option value="">- Pilih Sektor -</option>
					        	<option value="energi">Energi</option>
					        	<option value="afolu">Afolu</option>
					        	<option value="limbah">Limbah</option>
						</select>
					</div>
					<div class="col-md-6">
						<select class="form-control form-control-solid" name="worksheet">
							<option value="">- Pilih Worksheet -</option>
						</select>
					</div>
				</div>
				<form method="post" action="<?php echo $action; ?>">
					<?php if ($this->session->flashdata('save_status') == 'err'): ?>
					<div class="alert alert-danger mb-10">
						<?php echo $this->session->flashdata('save_message'); ?>
					</div>
					<?php endif; ?>

					<table class="table table-separate data tabel-worksheet table-head-custom table-checkable dataTable no-footer dtr-inline" id="kt_datatable" role="grid" aria-describedby="kt_datatable_info">
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
						</tbody>
					</table>
					<div class="card-footer" style="text-align: right;">
						<button type="submit" class="btn btn-primary mr-2">Simpan</button>
					</div>
				</form>
		    </div>
		</div>
	</div>
</div>
<script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>

<script>
$().ready(function() {
	
	$('[name=sektor]').val('');
	
	var site_url = '<?php echo site_url(); ?>';
	
	
	// onchage dropdown "sektor"
	$('[name=sektor]').change(function() {
		
		// ambil value dari dropdown "sektor"
		var sektor = $(this).val();
		
		// kosongkan option dari dropdown "worksheet"
		$('[name=worksheet] option:gt(0)').remove();
		
		// ambil data dari server
		if (sektor != '') {
			$.post(
				site_url + '/pengaturan/parameter/get_sektor'
				, { sektor: sektor }
				, function(response) {
					
					// masukkan data ke option
					$.each (response, function(key, obj) {
						$('[name=worksheet]').append('<option value="'+obj.id+'">'+obj.nama+'</option>');
					});
				}
			);
		}
	});
	
	// onchage dropdown "worksheet"
	$('[name=worksheet]').change(function() {
		
		// ambil value dari dropdown "worksheet"
		var worksheet = $(this).val();
		
		// kosongkan tabel pemain
		$('.tabel-worksheet tbody').children().remove();
		
		// ambil data dari server
		if (worksheet != '') {
			$.post(
				site_url + '/pengaturan/parameter/get_worksheet'
				, { worksheet: worksheet }
				, function(response) {
					if (response.length == 0) {
						$('.tabel-worksheet tbody').append('<tr><td colspan="3">Tidak ada data worksheet.</td></tr>');
					}
					else {
						// masukkan data pemain
						var no = 1;
						$.each (response, function(key, obj) {
							var nama = obj.keterangan;
							if (nama != null){
								var ket = obj.keterangan;
							}else{
								var ket = "";
							}
							$('.tabel-worksheet tbody').append(
								'<tr>'+
									'<td>'+obj.id+'</td>'+
									'<td>'+obj.nama+'</td>'+
									'<td>'+obj.satuan+'</td>'+
									'<td>'+obj.nilai_default+'</td>'+
									'<td><input type="text" class="form-control form-control-solid" name="nilai[]" value="'+obj.nilai+'"/></td>'+
									'<td><input type="text" class="form-control form-control-solid" name="keterangan[]" value="'+ket+'"/></td>'+
								'</tr>'+
								'<input type="hidden" name="id[]" value="'+obj.id+'">'
							);
							no++;
						});
					}
				}
			);
		}
	});
	
});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('.data').DataTable({
	        "scrollY": 350,
	        "scrollX": true
		});
	});
</script>