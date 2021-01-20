<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
<div class="d-flex flex-row">
	<div class="col-md-12">
		<div class="card card-custom gutter-b">
			<div class="card-body">
				<?php $this->load->view('form_'.$tipe); ?>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="card card-custom card-stretch gutter-b">
					<?php $this->load->view('form_metadata_'.$tipe); ?>
				</div>
			</div>
			<div class="col-lg-12">
				<div class="card card-custom card-stretch gutter-b">
					<?php $this->load->view('form_riwayat_data_'.$tipe); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript" src="//cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>