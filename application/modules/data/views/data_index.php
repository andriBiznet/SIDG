<div class="row">
	<div class="col-md-12">
		<div class="card card-custom gutter-b">
			<div class="card-body">
				<ul class="list-group list-group-flush">
					<?php foreach ($forms->result() as $row): ?>
					<li class="list-group-item"><a href="<?php echo site_url('/form/'.$row->id); ?>"><?php echo $row->nama; ?></a></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>