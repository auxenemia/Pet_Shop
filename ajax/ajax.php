<?php include_once('connect.inc');
	function main(){
		echo '<div class="center">
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="sr-only"><select name="kode" id="kode" data-placeholder="Kode Produk" style="width:100%;" class="chzn-select" tabindex="2">
										<option></option>
									</select></div>
								<div class="menua">
									<button class="btn btn-success btn-circle" onclick="login(\'a\')">&nbsp;&nbsp;Stock&nbsp;&nbsp;</button>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="menub">
									<button class="btn btn-warning btn-circle" onclick="login(\'b\')">Cashier</button>
								</div>
							</div>
						</div>
					</div>';
	}
	function login(){
		echo '<div class="center">
						<div class="form-signin">
							<div id="error" class="error none"><small>*invalid username or password</small></div>
							<label for="username" class="sr-only">Email address</label>
							<input type="text" id="username" class="form-control" placeholder="Username" autocomplete="off" required autofocus>
							<label for="inputPassword" class="sr-only">Password</label>
							<input type="password" id="password" class="form-control" placeholder="Password" required>
							<button class="btn btn-lg btn-primary btn-block" type="submit" onclick="validate()">Sign in</button>
						</div>
					</div>';
	}
	function stock(){
		mysql_open();
		$sql = "SELECT * FROM `Produk` ORDER BY `Kode` ASC";
		$res = @mysql_query($sql) or die(mysql_error());
		if(mysql_num_rows($res) > 0){
			$xo .= '<div class="add" data-toggle="tooltip" data-placement="left" title="Tambah Produk">
								<button class="btn btn-default" data-toggle="modal" data-target="#myModal"><i class="glyphicon glyphicon-plus"></i></button>
							</div>
							<!-- Modal -->
							<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h1 class="modal-title" id="myModalLabel" style="text-align:center;">Tambah Produk</h1>
										</div>
										<div class="modal-body">
											<div class="form-horizontal">
												<div class="form-group">
													<label for="kode" class="col-xs-2 control-label">Kode</label>
													<div class="col-xs-9">
														<input type="text" class="form-control" id="a" placeholder="Kode Produk" required>
													</div>
												</div>
												<div class="form-group">
													<label for="nama" class="col-xs-2 control-label">Nama</label>
													<div class="col-xs-9">
														<input type="text" class="form-control" id="b" placeholder="Nama Produk" required>
													</div>
												</div>
												<div class="form-group">
													<label for="jenis" class="col-xs-2 control-label">Jenis</label>
													<div class="col-xs-9">
														<input type="text" class="form-control" id="c" placeholder="Jenis Produk" required>
													</div>
												</div>
												<div class="form-group">
													<label for="harga" class="col-xs-2 control-label">Harga</label>
													<div class="col-xs-9">
														<input type="number" class="form-control" id="d" placeholder="Harga Produk" required>
													</div>
												</div>
												<div class="form-group">
													<label for="stok" class="col-xs-2 control-label">Stok</label>
													<div class="col-xs-9">
														<input type="number" class="form-control" id="e" placeholder="Stok Produk" required>
													</div>
												</div>
												<div class="form-group">
													<label for="supplier" class="col-xs-2 control-label">Supplier</label>
													<div class="col-xs-9">
														<input type="text" class="form-control" id="f" placeholder="Supplier Produk" required>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
											<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="insert()">Simpan</button>
										</div>
									</div><!-- /.modal-content -->
								</div><!-- /.modal-dialog -->
							</div><!-- /.modal -->
							<div class="container" style="background-color:#fff;">
								<table class="table table-striped table-hover table-responsive">
									<thead>
										<tr>
											<th>#</th>
											<th>Kode Produk</th>
											<th>Nama Produk</th>
											<th>Jenis Produk</th>
											<th>Harga</th>
											<th>Stok</th>
											<th>Supplier</th>
											<th class="text-center">Ubah</th>
											<th class="text-center">Hapus</th>
										</tr>
									</thead>
									<tbody>';
			while($row = mysql_fetch_assoc($res)){
				$sql_ = "SELECT * FROM `Supplier` WHERE `ID`=(SELECT `ID Supplier` FROM `Pesanan` WHERE `Kode Produk`='".$row['Kode']."' LIMIT 1) LIMIT 1";
				$res_ = @mysql_query($sql_) or die(mysql_error());
				if(mysql_num_rows($res_) == 1){
					$row_ = mysql_fetch_assoc($res_);
				}
				$xo .= '		<tr>
											<td>'.++$i.'</td>
											<td>'.$row['Kode'].'</td>
											<td>'.$row['Nama'].'</td>
											<td>'.$row['Jenis'].'</td>
											<td>'.$row['Harga'].'</td>
											<td>'.$row['Stok'].'</td>
											<td>'.$row_['Nama'].'</td>
											<td class="text-center"><button class="btn btn-xs btn-warning" data-toggle="modal" data-target="#myModal'.$i.'"><i class="glyphicon glyphicon-edit"></i></button></td>
											<td class="text-center"><button class="btn btn-xs btn-danger" data-toggle="modal" data-target="#myModall'.$i.'"><i class="glyphicon glyphicon-trash"></i></button></td>
										</tr>
										<!-- Modal -->
										<div class="modal fade" id="myModal'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h1 class="modal-title" id="myModalLabel" style="text-align:center;">'.$row['Nama'].'</h1>
													</div>
													<div class="modal-body">
														<div class="form-horizontal">
															<div class="form-group">
																<label for="kode" class="col-xs-2 control-label">Kode</label>
																<div class="col-xs-9">
																	<input type="text" class="form-control" id="a'.$i.'" placeholder="Kode Produk" value="'.$row['Kode'].'" disabled>
																</div>
															</div>
															<div class="form-group">
																<label for="nama" class="col-xs-2 control-label">Nama</label>
																<div class="col-xs-9">
																	<input type="text" class="form-control" id="b'.$i.'" placeholder="Nama Produk" value="'.$row['Nama'].'" required>
																</div>
															</div>
															<div class="form-group">
																<label for="jenis" class="col-xs-2 control-label">Jenis</label>
																<div class="col-xs-9">
																	<input type="text" class="form-control" id="c'.$i.'" placeholder="Jenis Produk" value="'.$row['Jenis'].'" required>
																</div>
															</div>
															<div class="form-group">
																<label for="harga" class="col-xs-2 control-label">Harga</label>
																<div class="col-xs-9">
																	<input type="number" class="form-control" id="d'.$i.'" placeholder="Harga Produk" value="'.$row['Harga'].'" required>
																</div>
															</div>
															<div class="form-group">
																<label for="stok" class="col-xs-2 control-label">Stok</label>
																<div class="col-xs-9">
																	<input type="number" class="form-control" id="e'.$i.'" placeholder="Stok Produk" value="'.$row['Stok'].'" required>
																</div>
															</div>
															<div class="form-group">
																<label for="supplier" class="col-xs-2 control-label">Supplier</label>
																<div class="col-xs-9">
																	<input type="text" class="form-control" id="f'.$i.'" placeholder="Supplier Produk" value="'.$row_['Nama'].'" required>
																</div>
															</div>
														</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
														<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="update('.$i.')">Simpan</button>
													</div>
												</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
										</div><!-- /.modal -->
										<!-- Modal -->
										<div class="modal fade" id="myModall'.$i.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
														<h1 class="modal-title" id="myModalLabel" style="text-align:center;">Hapus Produk</h1>
													</div>
													<div class="modal-body">
														<div class="text-center" style="font-size:larger;">Hapus <strong>['.$row['Kode'].'] '.$row['Nama'].'</strong> dari daftar produk...?</div>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
														<button type="button" class="btn btn-danger" data-dismiss="modal" onclick="delet('.$i.')">Hapus</button>
													</div>
												</div><!-- /.modal-content -->
											</div><!-- /.modal-dialog -->
										</div><!-- /.modal -->';
			}
			$xo .= '		</tbody>
								</table>
							</div>';
		}
		mysql_close();
		echo $xo;
	}
	function insert(){
		mysql_open();
		mysql_query("START TRANSACTION");
		$sql = "INSERT INTO `Produk` VALUES ('".strip_tags(trim(mysql_real_escape_string($_GET['a'])))."','".strip_tags(trim(mysql_real_escape_string($_GET['b'])))."','".strip_tags(trim(mysql_real_escape_string($_GET['c'])))."',".strip_tags(trim(mysql_real_escape_string($_GET['d']))).",".strip_tags(trim(mysql_real_escape_string($_GET['e']))).")";
		$res = @mysql_query($sql) or die(mysql_error());
		if(!$res){$error[] = 'error_1';}
		$sql_ = "SELECT * FROM `Supplier` WHERE UPPER(`Nama`) LIKE UPPER('%".$_GET['f']."%') LIMIT 1";
		$res_ = @mysql_query($sql_) or die(mysql_error());
		if(mysql_num_rows($res_) == 1){
			$row_ = mysql_fetch_assoc($res_);
			$id = $row_['ID'];
		}else{
			$sql__ = "INSERT INTO `Supplier` VALUES (NULL,'".strip_tags(trim(mysql_real_escape_string($_GET['f'])))."')";
			$res__ = @mysql_query($sql__) or die(mysql_error());
			if(mysql_affected_rows() == 1){
				$id = mysql_insert_id();
			}else{
				$error[] = 'error_2';
			}
		}
		$sql__ = "INSERT INTO `Pesanan` VALUES ('".strip_tags(trim(mysql_real_escape_string($_GET['a'])))."',".$id.")";
		$res__ = @mysql_query($sql__) or die(mysql_error());
		if(!$res__){$error[] = 'error_3';}
		if(empty($error)){
			mysql_query("COMMIT");
		}else{
			mysql_query("ROLLBACK");
		}
		mysql_close();
	}
	function update(){
		mysql_open();
		mysql_query("START TRANSACTION");
		$sql = "UPDATE `Produk` SET `Nama`='".strip_tags(trim(mysql_real_escape_string($_GET['b'])))."',`Jenis`='".strip_tags(trim(mysql_real_escape_string($_GET['c'])))."',`Harga`=".strip_tags(trim(mysql_real_escape_string($_GET['d']))).",`Stok`=".strip_tags(trim(mysql_real_escape_string($_GET['e'])))." WHERE `Kode`='".$_GET['a']."' LIMIT 1";
		$res = @mysql_query($sql) or die(mysql_error());
		if(!$res){$error[] = 'error_1';}
		$sql_ = "SELECT * FROM `Supplier` WHERE UPPER(`Nama`) LIKE UPPER('%".$_GET['f']."%') LIMIT 1";
		$res_ = @mysql_query($sql_) or die(mysql_error());
		if(mysql_num_rows($res_) == 1){
			$row_ = mysql_fetch_assoc($res_);
			$id = $row_['ID'];
		}else{
			$sql__ = "INSERT INTO `Supplier` VALUES (NULL,'".strip_tags(trim(mysql_real_escape_string($_GET['f'])))."')";
			$res__ = @mysql_query($sql__) or die(mysql_error());
			if(mysql_affected_rows() == 1){
				$id = mysql_insert_id();
			}else{
				$error[] = 'error_2';
			}
		}
		$sql__ = "UPDATE `Pesanan` SET `ID Supplier`=".$id." WHERE `Kode Produk`='".$_GET['a']."' LIMIT 1";
		$res__ = @mysql_query($sql__) or die(mysql_error());
		if(!$res__){$error[] = 'error_3';}
		if(empty($error)){
			mysql_query("COMMIT");
		}else{
			mysql_query("ROLLBACK");
		}
		mysql_close();
	}
	function delet(){
		mysql_open();
		$sql = "DELETE FROM `Produk` WHERE `Kode`='".$_GET['delet']."' LIMIT 1";
		$res = @mysql_query($sql) or die(mysql_error());
		mysql_close();
	}
	function cashier(){
		mysql_open();
		$sql = "SELECT * FROM `Produk`";
		$res = @mysql_query($sql) or die(mysql_error());
		if(mysql_num_rows($res) > 0){
			while($row = mysql_fetch_assoc($res)){
				$kode .= '<option value="'.$row['Kode'].'">'.$row['Kode'].'</option>';
			}
		}
		mysql_close();
		echo '<div class="container-fluid">
						<div class="transaksi">
							<div class="row">
								<div class="col-xs-6">
									<fieldset>
										<legend>Data Transaksi</legend>
										<div class="input-group">
											<span class="input-group-addon">Tanggal &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
											<input id="datetime" class="form-control" type="text">
										</div>
										<div class="input-group">
											<span class="input-group-addon">Kasir &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
											<input id="kasir" class="form-control" type="text">
										</div>
										<div class="input-group">
											<span class="input-group-addon">ID Transaksi</span>
											<input id="transaksi" class="form-control" type="text">
										</div>
									</fieldset>
								</div>
								<div class="col-xs-6">
									<fieldset>
										<legend>Detail Transaksi</legend>
										<div class="row">
											<div class="col-xs-12 col-md-6">
												<div class="input-group">
													<span class="input-group-addon">ID Konsumen &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
													<input id="konsumen" class="form-control" type="text">
												</div>
											</div>
											<div class="col-xs-12 col-md-6">
												<div class="input-group">
													<span class="input-group-addon">Phone</span>
													<input id="phone" class="form-control" type="text">
												</div>
											</div>
										</div>
										<div class="input-group">
											<span class="input-group-addon">Nama Konsumen</span>
											<input id="nama" class="form-control" type="text">
										</div>
										<div class="input-group">
											<span class="input-group-addon">Alamat &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
											<input id="alamat" class="form-control" type="text">
										</div>
									</fieldset>
								</div>
							</div>
							<hr>
							<div class="row">
								<div class="col-xs-3">
									<div class="input-group">
										<span class="input-group-addon">Jumlah &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
										<input id="jumlah" class="form-control" type="number" value="1">
									</div>
								</div>
								<div class="col-xs-3" style="padding-left:0px;">
									<div class="input-group">
										<input id="kode" name="kode" type="text" class="form-control" placeholder="Kode Produk" onchange="addItem()" style="text-transform:uppercase;">
										<span class="input-group-btn">
											<button id="plus" class="btn btn-block btn-default" style="padding:6px 20px;" onclick="addItem()"> <i class="glyphicon glyphicon-plus"></i> </button>
										</span>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="pull-right">
										<h1 style="margin-top:0px;margin-bottom:0px;">Rp. <span name="total" id="total">0</span></h1>
									</div>
								</div>
							</div>
							<br>
							<div class="row">
								<div class="col-xs-12">
									<div  style="background-color:#fff;">
										<table class="table table-striped table-hover table-condensed table-responsive">
											<thead>
												<tr>
													<th>#</th>
													<th>Kode Produk</th>
													<th>Jenis Produk</th>
													<th>Nama Produk</th>
													<th>Jumlah</th>
													<th>Harga</th>
													<th>Subtotal</th>
												</tr>
											</thead>
											<tbody id="table"></tbody>
										</table>
									</div>
								</div>
							</div>
							<div style="position:fixed;bottom:20px;right:15px;">
								<button class="btn btn-primary" data-toggle="modal" data-target="#myModal">Submit</button>
							</div>
						</div>
					</div>
					<!-- Modal -->
					<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h1 class="modal-title" id="myModalLabel" style="text-align:center;">PEMBAYARAN</h1>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-xs-4"><h3>TOTAL</h3></div>
										<div class="col-xs-1"><h3>:</h3></div>
										<div class="col-xs-7"><h3 class="pull-right"><span id="total2">0</span></h3></div>
									</div>
									<div class="row">
										<div class="col-xs-4"><h3>TUNAI</h3></div>
										<div class="col-xs-1"><h3>:</h3></div>
										<div class="col-xs-7"><h3 class="pull-right"><input id="tunai" type="text" dir="rtl" style="width:100%;border:0px;" placeholder="0" autofocus onkeyup="bayar(this.value)"></h3></div>
									</div>
									<div class="row">
										<div class="col-xs-4"><h3>KEMBALI</h3></div>
										<div class="col-xs-1"><h3>:</h3></div>
										<div class="col-xs-7"><h3 class="pull-right"><span id="kembali">0</span></h3></div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-success" data-dismiss="modal" data-toggle="modal" data-target="#myModal1" onclick="ticket()">Print</button>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->
					<!-- Modal -->
					<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
									<h1 class="modal-title" id="myModalLabel" style="text-align:center;">FAKTUR</h1>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="col-xs-6"># <span id="pa"></span> / <span id="pf"></span></div>
										<div class="col-xs-6"><span class="pull-right">'.date('Y-m-d H:i:s').'</span></div>
									</div>
									<div class="row">
										<div class="col-xs-12"># <span id="pb"></span> / <span id="pc"></span> / <span id="pd"></span> / <span id="pe"></span></div>
									</div>
									<hr>
									<div id="pg"></div>
									<hr>
									<div class="row">
										<div class="col-xs-10"><span class="pull-right">TOTAL :</span></div>
										<div class="col-xs-2"><span id="ph" class="pull-right"></span></div>
									</div>
									<div class="row">
										<div class="col-xs-10"><span class="pull-right">TUNAI :</span></div>
										<div class="col-xs-2"><span id="pi" class="pull-right"></span></div>
									</div>
									<div class="row">
										<div class="col-xs-10"><span class="pull-right">KEMBALI :</span></div>
										<div class="col-xs-2"><span id="pj" class="pull-right"></span></div>
									</div>
								</div>
								<div class="modal-footer">
									<div style="text-align:center;"><i class="glyphicon glyphicon-hand-right"></i> &nbsp; TERIMA KASIH DAN SELAMAT BELANJA KEMBALI &nbsp; <i class="glyphicon glyphicon-hand-left"></i></div>
								</div>
							</div><!-- /.modal-content -->
						</div><!-- /.modal-dialog -->
					</div><!-- /.modal -->';
	}
	function item(){
		mysql_open();
		$sql = "SELECT * FROM `Produk` WHERE `Kode`='".$_GET['item']."' LIMIT 1";
		$res = @mysql_query($sql) or die(mysql_error());
		session_start();
		if(mysql_num_rows($res) == 1){
			foreach($_SESSION['item'] as $item){
				$i++;
				if($item['kode'] == $_GET['item']){
					$add = true;
					$index = $i;
					break;
				}
			}
			if($add){
				$_SESSION['item'][$index-1] = array('kode'=>$_GET['item'],'jumlah'=>$_SESSION['item'][$index-1]['jumlah']+1);
			}else{
				$_SESSION['item'][] = array('kode'=>$_GET['item'],'jumlah'=>$_GET['jumlah']);
			}
		}
		foreach($_SESSION['item'] as $item){
			$sql = "SELECT * FROM `Produk` WHERE `Kode`='".$item['kode']."' LIMIT 1";
			$res = @mysql_query($sql) or die(mysql_error());
			if(mysql_num_rows($res) == 1){
				$row = mysql_fetch_assoc($res);
				$xo .= '<tr><td>'.++$j.'</td><td>'.$row['Kode'].'</td><td>'.$row['Jenis'].'</td><td>'.$row['Nama'].'</td><td>'.$item['jumlah'].'</td><td>'.$row['Harga'].'</td><td>'.$row['Harga']*$item['jumlah'].'</td></tr>';
			}
		}
		mysql_close();
		echo $xo;
	}
	function total(){
		mysql_open();
		session_start();
		foreach($_SESSION['item'] as $item){
			$sql = "SELECT * FROM `Produk` WHERE `Kode`='".$item['kode']."' LIMIT 1";
			$res = @mysql_query($sql) or die(mysql_error());
			if(mysql_num_rows($res) == 1){
				$row = mysql_fetch_assoc($res);
				$xo += $row['Harga']*$item['jumlah'];
			}
		}
		mysql_close();
		echo $xo;
	}
	function ticket(){
		mysql_open();
		session_start();
		$xo .= '<div class="row">';
		foreach($_SESSION['item'] as $item){
			$sql = "SELECT * FROM `Produk` WHERE `Kode`='".$item['kode']."' LIMIT 1";
			$res = @mysql_query($sql) or die(mysql_error());
			if(mysql_num_rows($res) == 1){
				$row = mysql_fetch_assoc($res);
				$to += $row['Harga']*$item['jumlah'];
				$xo .= '<div class="col-xs-7">'.$row['Nama'].'</div><div class="col-xs-1">'.$item['jumlah'].'</div><div class="col-xs-2"><span class="pull-right">'.$row['Harga'].'</span></div><div class="col-xs-2"><span class="pull-right">'.$row['Harga']*$item['jumlah'].'</span></div>';
			}
		}
		$xo .= '</div>';
		session_destroy();
		mysql_close();
		echo $xo;
	}
	if(isset($_GET['login'])){login();}
	elseif(isset($_GET['stock'])){stock();}
	elseif(isset($_GET['cashier'])){cashier();}
	elseif(isset($_GET['item'])){item();}
	elseif(isset($_GET['ticket'])){ticket();}
	elseif(isset($_GET['total'])){total();}
	elseif(isset($_GET['insert'])){insert();}
	elseif(isset($_GET['update'])){update();}
	elseif(isset($_GET['delet'])){delet();}
	else{main();}
?>
