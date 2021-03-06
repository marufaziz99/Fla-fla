<script>
	function printDiv(divName) {
		var printContent = document.getElementById(divName).innerHTML;
		var originalContent = document.body.innerHTML;

		document.body.innerHTML = printContent;

		window.print();

		document.body.innerHTML = originalContent;
	}
</script>

<div class="page-title">
	<div class="title_left">
		<h3>Laporan Pemakaian</h3>
	</div>

	<div class="title_right">
		<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search for...">
				<span class="input-group-btn">
					<button class="btn btn-default" type="button">Go!</button>
				</span>
			</div>
		</div>
	</div>
</div>

<div class="clearfix"></div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12">
		<button onclick="printDiv('content')" class="btn btn-primary"><i class="fa fa-print"> &nbsp;<b>Print</b></i></button>
		<button onclick="window.history.back()" class="btn btn-danger"><i class="fa fa-reply"> &nbsp;<b>Back</b></i></button>

		<div class="x_panel">
			<div class="x_title">
				<h2><i class="fa fa-bars"></i> Laporan Pemakaian </h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
					</li>
					<li><a class="close-link"><i class="fa fa-close"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content" id="content">
				<h4 align="center">
					Region : <a class="btn btn-primary btn-sm"><?= $region ?></a> | Tanggal : <a class="btn btn-primary btn-sm"><?= $tanggal ?></a> | Shift : <a class="btn btn-primary btn-sm"><?= $shift ?></a>
				</h4>
				<div class="row">
					<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<center><span>Powder</span></center>
							<table class="table table-striped jambo_table bulk_action" id="myTable1">
								<thead>
									<tr class="headings">
										<th class="column-title">Powder </th>
										<th class="column-title">Stok Awal </th>
										<th class="column-title">Penambahan </th>
										<th class="column-title">Basic </th>
										<th class="column-title">Pm </th>
										<th class="column-title">Hot </th>
										<th class="column-title">Yakult </th>
										<th class="column-title">Juice </th>
										<th class="column-title">Sisa </th>
									</tr>
								</thead>

								<tbody>
									<?php
									foreach ($powder as $key => $value) {
									?>
										<tr>
											<td><?= $value->nama_powder ?></td>
											<td style="text-align: center"><?= $value->stok_awal ?></td>
											<td style="text-align: center"><?= $value->penambahan ?></td>
											<td style="text-align: center"><?= ($value->basic_use != NULL ? $value->basic_use : '-') ?></td>
											<td style="text-align: center"><?= ($value->pm_use != NULL ? $value->pm_use : '-') ?></td>
											<td style="text-align: center"><?= ($value->hot_use != NULL ? $value->hot_use : '-') ?></td>
											<td style="text-align: center"><?= ($value->yakult_use != NULL ? $value->yakult_use : '-') ?></td>
											<td style="text-align: center"><?= ($value->juice_use != NULL ? $value->juice_use : '-') ?></td>
											<td style="text-align: center"><?= $value->sisa ?></td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>

					<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<center><span>Topping</span></center>
							<table class="table table-striped jambo_table bulk_action" id="myTable1">
								<thead>
									<tr class="headings">
										<th class="column-title">Nama </th>
										<th class="column-title">Pemakaian </th>
										<th class="column-title">Harga </th>
										<th class="column-title">Penjualan</th>
									</tr>
								</thead>

								<tbody>
									<?php
									$harga = 0;
									foreach ($topping as $key => $value) {
										if ($value->harga_jual != 0) {
											$harga = $value->harga_jual;
										} else {
											$harga = $value->harga;
										}
									?>
										<tr>
											<td><?= $value->nama_topping ?></td>
											<td><?= ($value->pakai != null ? $value->pakai : 0) ?></td>
											<td><?= 'Rp ' . number_format($harga, '0', ',', '.') ?></td>
											<td><?= 'Rp ' . number_format(($value->pakai != null ? $value->pakai * $harga : 0), '0', ',', '.') ?></td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-5 col-md-5 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<center><span>Masak Bubble</span></center>
							<table class="table table-striped jambo_table bulk_action" id="myTable1">
								<thead>
									<tr class="headings">
										<th class="column-title">Masak Bubble </th>
										<th class="column-title">Stok awal </th>
										<th class="column-title">Pemakaian </th>
										<th class="column-title">Sisa</th>
									</tr>
								</thead>

								<tbody>
									<?php
									foreach ($bubble as $key => $value) {
										$shift;
										if ($value->waktu >= '07:00:00' && $value->waktu <= '16:00:00') {
											$shift = 'Shift 1';
										} else if ($value->waktu > '16:00:00' && $value->waktu <= '22:00:00') {
											$shift = 'Shift 2';
										}
									?>
										<tr>
											<td><?= $shift ?></td>
											<td><?= $value->stock_awal ?></td>
											<td><?= $value->pakai ?></td>
											<td><?= $value->stock_awal - $value->pakai ?></td>
										</tr>

									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>

					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<center><span>Penjualan</span></center>
							<table class="table table-striped jambo_table bulk_action" id="myTable1">
								<thead>
									<tr class="headings">
										<th class="column-title">Nama Menu </th>
										<th class="column-title">Penjualan </th>
										<th class="column-title">Harga </th>
										<th class="column-title">Total</th>
									</tr>
								</thead>

								<tbody>
									<?php
									foreach ($penjualan as $key => $value) {
									?>
										<tr>
											<td><?= $value->nama_jenis . ' ' . $value->nama_penyajian ?></td>
											<td><?= ($value->pakai != null ? $value->pakai : 0) ?></td>
											<td><?= 'Rp ' . number_format($value->harga_jual, '0', ',', '.') ?></td>
											<td><?= 'Rp ' . number_format(($value->pakai != null ? $value->pakai * $value->harga_jual : 0), '0', ',', '.') ?></td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<center><span>Pemakaian Susu Putih</span></center>
							<table class="table table-striped jambo_table bulk_action putih" id="myTable1">
								<thead>
									<tr class="headings">
										<th class="column-title">Susu Putih </th>
										<th class="column-title">Basic </th>
										<th class="column-title">PM </th>
									</tr>
								</thead>

								<tbody>
									<?php
									$bs = 0;
									$pm = 0;
									$total_bs = 0;
									$total_pm = 0;
									foreach ($susu_putih as $key => $value) {
										$bs = $value->basic_b + $value->basic_p + $value->basic_y;
										$pm = $value->pm_b + $value->pm_p;

										$total_bs = $total_bs + $bs;
										$total_pm = $total_pm + $pm;
									?>
										<tr>
											<td><?= ($value->id_jenis != 3 && $value->id_jenis != 4 && $value->id_jenis != 6 ? $value->nama_jenis : '') ?></td>
											<td><?= ($value->id_jenis != 3 && $value->id_jenis != 4 && $value->id_jenis != 6 ? $bs : '') ?></td>
											<td><?= ($value->id_jenis != 3 && $value->id_jenis != 4 && $value->id_jenis != 6 ? $pm : '') ?></td>
										</tr>
									<?php
									}
									?>
									<tr style="background-color: #00CED1; color: #ffffff;">
										<td>Total</td>
										<td><?= $total_bs ?></td>
										<td><?= $total_pm ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<center><span>Pemakaian Susu Coklat</span></center>
							<table class="table table-striped jambo_table bulk_action coklat" id="myTable1">
								<thead>
									<tr class="headings">
										<th class="column-title">Susu Coklat </th>
										<th class="column-title">Basic </th>
										<th class="column-title">PM </th>
									</tr>
								</thead>

								<tbody>
									<?php
									$bs = 0;
									$pm = 0;
									$total_bs = 0;
									$total_pm = 0;
									foreach ($susu_coklat as $key => $value) {
										$bs = $value->basic_b + $value->basic_p;
										$pm = $value->pm_b + $value->pm_p;

										$total_bs = $total_bs + $bs;
										$total_pm = $total_pm + $pm;
									?>
										<tr>
											<td><?= ($value->id_jenis != 1 && $value->id_jenis != 2 && $value->id_jenis != 5 ? $value->nama_jenis : null) ?></td>
											<td><?= ($value->id_jenis != 1 && $value->id_jenis != 2 && $value->id_jenis != 5 ? $bs : null) ?></td>
											<td><?= ($value->id_jenis != 1 && $value->id_jenis != 2 && $value->id_jenis != 5 ? $pm : null) ?></td>
										</tr>
									<?php
									}
									?>

									<tr style="background-color: #00CED1; color: #ffffff;">
										<td>Total</td>
										<td><?= $total_bs ?></td>
										<td><?= $total_pm ?></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="table-responsive">
							<center><span>Stok Ekstra</span></center>
							<table class="table table-striped jambo_table bulk_action" id="myTable1">
								<thead>
									<tr class="headings">
										<th class="column-title" rowspan="2" style="text-align: center; vertical-align: middle">Nama Ekstra </th>
										<th class="column-title" rowspan="2" style="text-align: center; vertical-align: middle">Stok Awal </th>
										<th class="column-title" rowspan="2" style="text-align: center; vertical-align: middle">Penambahan </th>
										<th class="column-title" colspan="2" style="text-align: center">Pemakaian</th>
										<th class="column-title" rowspan="2" style="text-align: center; vertical-align: middle">Sisa</th>
									</tr>
									<tr>
										<th class="column-title" style="text-align: center">Hari ini</th>
										<th class="column-title" style="text-align: center">Bulan ini</th>
									</tr>
								</thead>

								<tbody>
									<?php
									foreach ($ekstra as $key => $value) {
										$pemakaian = 0;
										if ($value->nama_ekstra == "Susu Putih" || $value->nama_ekstra == "Susu Coklat") {
											$pemakaian = $value->pakai_susu;
										} else if ($value->nama_ekstra == "Hazel" || $value->nama_ekstra == "Rum" || $value->nama_ekstra == "Lychee") {
											$pemakaian = $value->sirup;
										} else {
											$pemakaian = $value->pakai;
										}
									?>
										<tr>
											<td><?= $value->nama_ekstra ?></td>
											<td style="text-align: center"><?= $value->stock_awal ?></td>
											<td style="text-align: center"><?= $value->penambahan ?></td>
											<td style="text-align: center"><?= ($pemakaian != null ? $pemakaian : 0) ?></td>
											<td style="text-align: center"><?= ($value->pakai_bulan != null ? $value->pakai_bulan : 0) ?></td>
											<td style="text-align: center"><?= $value->sisa ?></td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	$('.coklat > tbody  > tr').has('td:empty').hide();
	$('.putih > tbody  > tr').has('td:empty').hide();
</script>