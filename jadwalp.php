<?php

	include_once("config.php");
	if(isset($_SESSION['uid']))
		$akses = mysql_fetch_object(mysql_query("SELECT * FROM akun WHERE id = " . $_SESSION['uid']));

?>

<html>
<head>
	<link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet/less" type="text/css" href="styles.less"/>
	<script src="less-1.5.0.min.js" type="text/javascript"></script>
	<script src="jquery-1.10.2.js" type="text/javascript"></script>
    <script>
		var pesan_array = ['warning','error'];	 
		function hilang()
		{
				 var h = new Array();
				 for (i=0; i<pesan_array.length; i++)
				 {
						  h[i] = $('.' + pesan_array[i]).outerHeight();
						  $('.' + pesan_array[i]).css('top', -h[i]);	  
				 }
		}
		
		function tampil(type)
		{
			$('.'+ type +'-trigger').click(function(){
				  hilang();				  
				  $('.'+type).animate({top:"0"}, 500);
			});
		}
		
		$(document).ready(function(){
				 hilang();
				 for(var i=0;i<pesan_array.length;i++)
				 {
					tampil(pesan_array[i]);
				 }
				 
				 $('.message').click(function(){			  
						  $(this).animate({top: -$(this).outerHeight()}, 500);
				  });		 
				 
		});       
	</script>
	<script type="text/javascript">
		function deleteMatkul(x){
            $.post("insidious.php",
            {
                pin: "5",
                id: x
                
            },
            function(data,status){
            	$("#main-content").load("cloud.php #sukses-delete");
            });
        }
	
	</script>
	<title>Home</title>
</head>
<body>
	<?php if(isset($akses)){ ?>
        <header>
            <nav>
                <ul>
                    <?php if($akses->level == "admin"){ ?>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="biodata.php">Input</a></li>
                        <li><a href="krs.php">Edit</a></li>
                        <li><a href="jadwalp.php" class="sedang-dibuka">Delete</a></li>
                    <?php }else{ ?>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="biodata.php">Biodata</a></li>
                        <li><a href="krs.php">Krs</a></li>
                        <li><a href="jadwalp.php" class="sedang-dibuka">Jadwal</a></li>
                    <?php } ?>
                </ul>
                <ul id="logout-box">
                    <li><a href="home.php" id="username-box"><?php echo $akses->username; ?></a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        <div class="error message">
                 <h3>Notifikasi Error</h3>
                 <p>Klik untuk hilang</p>
        
        </div>
        
        <div class="warning message">
                 <h3>Notifikasi warning</h3>
                 <p>Klik untuk hilang</p>
        </div>
        
        <ul id="trigger-list">
                 <li><a href="#" class="error-trigger">Error</a></li>
                 <li><a href="#" class="warning-trigger">Warning</a></li>
        </ul>

        <div id="center">
            <article id="article-home">
                <?php if($akses->level == "admin"){ ?>
                		<div id="article-menu">
                </div>
                <div id="article-konten">
                        <div id="main-content">
							<table id="table_data">
							<tr><td>Kode</td>
								<td>Matakuliah</td>
								<td>Semester</td>
								<td>Sks</td>
								<td>Delete</td>
							</tr>
								<?php 
								$query = mysql_query("SELECT * FROM matakuliah");
								while($x = mysql_fetch_object($query)):
								?>
									<?php echo "<tr>
													<td id='id_matkul'>$x->kode</td>
													<td>$x->mtk</td>
													<td>$x->semester</td>
													<td>$x->sks</td>
													<td><input type='button' onclick = 'deleteMatkul(".$x->id.")'/></td>
												</tr>"; ?>
								<?php endwhile; ?>
							</table>
						</div>
					</div>
                    <?php }else{ ?>
                        <div id="main-content2">
                        	<?php
								function Bulan($input){
									if($input == 1){
										echo "januari";
									}
									else if($input == 2){
										echo "februari";
									}
									else if($input == 3){
										echo "maret";
									}
									else if($input == 4){
										echo "april";
									}
									else if($input == 5){
										echo "mei";
									}
									else if($input == 6){
										echo "juni";
									}
									else if($input == 7){
										echo "juli";
									}
									else if($input == 8){
										echo "agustus";
									}
									else if($input == 9){
										echo "september";
									}
									else if($input == 10){
										echo "oktober";
									}
									else if($input == 11){
										echo "november";
									}
									else if($input == 12){
										echo "desember";
									}
								}

								/*
								$tgl = date("j"); // tanggal hari ini
								$bln = date("n"); // bulan ini
								$thn = date("Y"); // tahun ini
								$hari = date("w"); // hari (minggu = 0 , sabtu = 6)
								$tgl_l = date("t",strtotime("-1 month")); // byk hari di bulan sebelumnya
								*/

								$hari = date("N");
								$bantu_t = 0; // untuk pengurangan tanggal

								while($hari > 1){
									$hari -= 1;
									$bantu_t += 1;
								}

								$uji = 0;
								$tgl = date("j");
								$tgl_s = date("t");
								$bln = date("n");
								$thn = date("Y");
								$tgl_l = date("t",strtotime("-1 month"));

								for($i = 0 ; $i < $bantu_t ; $i++){
									if($tgl == 1){
										$uji = 1;
										$tgl = $tgl_l;
										if($bln == 1){
											$bln = 12;
											$thn--;
										}
										else{
											$bln--;
										}
									}
									else{
										$tgl--;
									}
								}

	
								//Pencetakan hasil
								for($i = 0 ; $i < 7 ; $i++){
									echo $tgl . " ";
									Bulan($bln);
									echo " " . $thn . " | ";
									if(($tgl == $tgl_l) && ($uji == 1)){
										$tgl = 1;
										if($bln == 12){
											$bln = 1;
											$thn++;
										}
										else{
											$bln++;
										}
										$uji = 0;
									}
									else{
										if(($tgl == $tgl_s) && ($uji != 1)){
											$tgl = 1;
											if($bln == 12){
												$bln = 1;
												$thn++;
											}
											else{
												$bln++;
											}
										}
										else{
											$tgl++;
										}
									}
								}
								echo '<table align="center" border="1">
										<tr>
											<td>&nbsp;</td>
											<td>'.$arr_tgl[0].'<br/>'.Bulan($arr_bln[0]).'<br/>'.$arr_thn[0].'</td>
											<td>'.$arr_tgl[1].'<br/>'.Bulan($arr_bln[1]).'<br/>'.$arr_thn[1].'</td>
											<td>'.$arr_tgl[2].'<br/>'.Bulan($arr_bln[2]).'<br/>'.$arr_thn[2].'</td>
											<td>'.$arr_tgl[3].'<br/>'.Bulan($arr_bln[3]).'<br/>'.$arr_thn[3].'</td>
											<td>'.$arr_tgl[4].'<br/>'.Bulan($arr_bln[4]).'<br/>'.$arr_thn[4].'</td>
											<td>'.$arr_tgl[5].'<br/>'.Bulan($arr_bln[5]).'<br/>'.$arr_thn[5].'</td>
										</tr>
										<tr>
											<td>JAM</td>
											<td>Senin</td>
											<td>Selasa</td>
											<td>Rabu</td>
											<td>Kamis</td>
											<td>Jumat</td>
											<td>Sabtu</td>
										</tr>
										<tr>
											<td>I</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>II</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>III</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>IV</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
										<tr>
											<td>V</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
											<td>&nbsp;</td>
										</tr>
								 	  </table>';

							?>
                        </div>
                    <?php } ?>
            </article>
        </div>
    <?php
		}
		else
			header("Location: index.php");
	?>
</body>
</html>