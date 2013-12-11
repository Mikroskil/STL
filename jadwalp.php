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
		function deleteMatkul(){
            $.post("insidious.php",
            {
                pin: "5",
                id_matkul: $("#id_matkul").text(),
                
            },
            function(data,status){
                //alert(document.getElementById("id_matkul").value);
				alert(data);
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
                        <div id="main-content">
							<table id="table_data">
							<tr><td>kode Matkul</td>
								<td>mata kuliah</td>
								<td>semester</td>
								<td>sks</td>
								<td>&nbsp;</td>
							</tr>
								<?php 
								$query = mysql_query("SELECT * FROM matakuliah");
								while($x = mysql_fetch_object($query)):
								?>
									<?php echo "<tr>
													<td id='id_matkul'>$x->Kode</td>
													<td>$x->mtk</td>
													<td>$x->semester</td>
													<td>$x->sks</td>
													<td><button onclick = 'deleteMatkul()'>delete</button></td>
												</tr>"; ?>
								<?php endwhile; ?>
							</table>
						</div>
                    <?php }else{ ?>
                        <div id="main-content2"></div>
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