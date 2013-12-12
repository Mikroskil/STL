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
			$("#KontenUtamaEdit").load("cloud.php #PilihanEdit");
				 hilang();
				 for(var i=0;i<pesan_array.length;i++)
				 {
					tampil(pesan_array[i]);
				 }
				 
				 $('.message').click(function(){			  
						  $(this).animate({top: -$(this).outerHeight()}, 500);
				  });		 
				 
		});
		function menujuKe(a){
            if(a == "Mata Kuliah")
                $("#KontenUtamaEdit").load("cloud.php #FormEditMatkul");
            else if(a == "Dosen")
                $("#KontenUtamaEdit").load("cloud.php #FormEditDosen");
            else if(a == "Jadwal Kuliah")
                $("#KontenUtamaEdit").load("cloud.php #FormEditJadwal");
        }
        function menujuKeFormDosenEdit(x){
            $.post("insidious.php",
            {
                pin: "6",
                nip: x
            },
            function(data,status){
                $("#KontenUtamaEdit").html(data);
            });
        }
        function back(){
            $("#KontenUtamaEdit").load("cloud.php #PilihanInput");
        }
        function menujuKeFormDosenEditUpdate(x){
            $.post("insidious.php",
            {
                pin: "7",
                id: x,
                nip: $("#nip-dosen").val(),
                nama: $("#nama-dosen").val()
            },
            function(data,status){
                $("#KontenUtamaEdit").load("cloud.php #PilihanInput");
            });
        }
        function menujuKeFormMatkulEdit(x){
            $.post("insidious.php",
            {
                pin: "8",
                id: x
            },
            function(data,status){
                $("#KontenUtamaEdit").html(data);
            });
        }
        function menujuKeFormMatkulEditUpdate(x){
            $.post("insidious.php",
            {
                pin: "9",
                id: x,
                kode: $("#kode-matkul").val(),
                matkul: $("#matkul").val(),
                pilSem: pilSemester.options[pilSemester.selectedIndex].text,
                pilSks: pilSks.options[pilSks.selectedIndex].text
            },
            function(data,status){
                $("#KontenUtamaEdit").load("cloud.php #PilihanInput");
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
                        <li><a href="krs.php" class="sedang-dibuka">Edit</a></li>
                        <li><a href="jadwalp.php">Delete</a></li>
                    <?php }else{ ?>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="biodata.php">Biodata</a></li>
                        <li><a href="krs.php" class="sedang-dibuka">Krs</a></li>
                        <li><a href="jadwalp.php">Jadwal</a></li>
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
                <div id="article-menu">
                </div>
                <div id="article-konten">
                <div id="KontenUtamaEdit">
                </div>
                </div>
            </article>
        </div>
    <?php
		}
		else
			header("Location: index.php");
	?>
</body>
</html>