<div class="d-flex flex-row">
	<div class="flex-row-fluid ml-lg-8">
		<!--begin::Row-->
		<div class="card card-custom gutter-b">
			<!--begin::Header-->
			<div class="card-header py-3">
				<div class="card-title align-items-start flex-column">
					<span class="navi-icon mr-2">
					<span class="navi-text">Hak Akses Menu</span>
				</div>
			</div>
			<!--end::Header-->
			<!--begin::Body-->
			<form method="post" action="<?php echo $action_menu; ?>">
				<div class="card-body py-0">
					<!--begin::Table-->
					<div class="table-responsive">
						<table class="table table-head-custom table-vertical-center" id="kt_advance_table_widget_2">
							<thead>
								<tr class="text-uppercase">
									<th class="pl-0" style="min-width: 20px;">No.</th>
									<th style="min-width: 120px;text-align: center;">Menu</th>
									<th class="pl-0" style="width: 40px">
										<label class="checkbox checkbox-lg checkbox-inline mr-2">
											<input type="checkbox" name="grant_all">
											<span></span>
										</label>
									</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 1; ?>
								<?php foreach ($menu as $menu_id => $m): ?>
								<?php $sub_menu = array_key_exists('sub_menu', $m); ?>
								<tr style="background: #f3f6f9;">
									<td class="pl-0" style="width: 10px">
										&nbsp;&nbsp;<?php echo $no; ?>.
									</td>
									<td>
										<?php echo $m['text'] ?>
									</td>
									<?php if ($sub_menu): ?>
									<td></td>
									<?php else: ?>
									<td class="pl-0 py-6">
										<label class="checkbox checkbox-lg checkbox-inline">
											<input type="checkbox" class="read-access" name="access[<?php echo $menu_id; ?>]" <?php if ($m['access']) echo 'checked' ; ?> >
											<span></span>
										</label>
									</td>
									<?php endif; ?>
								</tr>
								<?php if ($sub_menu): ?>
								<?php $sub_no = 1; ?>
								<?php foreach ($m['sub_menu'] as $sub_menu_id => $sm): ?>
									<tr>
										<td><?php echo $no.'.'.$sub_no; ?>.</td>
										<td class="cell-indent"><?php echo $sm['text'] ?><input type="hidden" name="id_induk[<?php echo $sub_menu_id; ?>]" value="<?php echo $menu_id; ?>"></td>
										<td class="pl-0 py-6">
											<label class="checkbox checkbox-lg checkbox-inline">
												<input type="checkbox" class="read-access" name="access[<?php echo $sub_menu_id; ?>]" <?php if ($sm['access']) echo 'checked' ; ?> >
												<span></span>
											</label>
										</td>
									</tr>
								<?php $sub_no++; ?>
								<?php endforeach; ?>
								<?php endif; ?>
								<?php $no++; ?>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
						<!--end::Table-->
				</div>
					<div class="card-footer">
						<input type="hidden" name="id" value="<?php if ($data != null) echo $data->id; ?>">
						<button type="submit" class="btn btn-primary mr-2">Simpan</button>
					</div>
				</form>
			<!--end::Body-->
		</div>
		<!--end::Advance Table Widget 5-->
	</div>
</div>

<script type="text/javascript">
$().ready(function() {
	
	$('[name=grant_all]').click(function() {
		var is_checked = $(this).is(':checked');
		$('.read-access').each(function() { $(this).prop('checked', is_checked); });
	});
	
});
</script>