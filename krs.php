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
			$("#article-menu").load("cloud.php #PilihanEdit");
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
        function isiKRS(){
            var c=0;
            var cekbox = document.getElementsByName("cek");
            var kodematkul = document.getElementsByName("kodematkul");
            var arr = "";
            for(var i in cekbox){
                if(cekbox[i].checked == true){
                    c++;
                    arr += kodematkul[i].innerHTML;
                    arr += "|";
                }
            }
            
            $.post("insidious.php",
            {
                pin: "15",
                arr: arr,
                nim: $("#username-box").html()
            },
            function(data,status){
                $("#KontenKRS").load("cloud.php #sukses-input");
            });
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
                $("#KontenUtamaEdit").load("cloud.php #sukses-edit");
                location.reload();
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
                $("#KontenUtamaEdit").load("cloud.php #sukses-edit");
                location.reload();
            });
        }
        function menujuKeFormJadwalEdit(x){
            $.post("insidious.php",
            {
                pin: "10",
                id: x
            },
            function(data,status){
                $("#KontenUtamaEdit").html(data);
            });
        }
        function menujuKeFormJadwalEditUpdate(x){
            $.post("insidious.php",
            {
                pin: "14",
                id: x,
                waktu: waktuJ.options[waktuJ.selectedIndex].text,
                jurusan: jurusanJ.options[jurusanJ.selectedIndex].text,
                semester: semesterJ.options[semesterJ.selectedIndex].text,
                kelas: kelasJ.options[kelasJ.selectedIndex].text,
                hari: hariJ.options[hariJ.selectedIndex].text,
                mulai: mulaiJ.options[mulaiJ.selectedIndex].text,
                matkul: matkulJ.options[matkulJ.selectedIndex].text,
                dosen: dosenJ.options[dosenJ.selectedIndex].text,
                gedung: gedungJ.options[gedungJ.selectedIndex].text,
                ruangan: ruanganJ.options[ruanganJ.selectedIndex].text,
                lantai: lantaiJ.options[lantaiJ.selectedIndex].text
            },
            function(data,status){
                $("#KontenUtamaEdit").load("cloud.php #sukses-edit");
                location.reload();
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
                    <li><a id="username-box"><?php echo $akses->username; ?></a></li>
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
                    <div id="KontenUtamaEdit">
                    </div>
                    </div>             
				<?php }else{ ?>
                    <div id="KontenKRS">
                        <table>
                        <tr>
                            <td>Kode Matakuliah</td>
                            <td>Matakuliah</td>
                            <td>Semester</td>
                            <td>Sks</td>
                            <td>Pilih Matakuliah</td>
                        </tr>
                        <?php 
                        $query = mysql_query("SELECT * FROM matakuliah");
                        while($x = mysql_fetch_object($query)):
                        ?>
                            <tr>
                                <td name="kodematkul"><?php echo $x->kode; ?></td>
                                <td><?php echo $x->mtk; ?></td>
                                <td><?php echo $x->semester; ?></td>
                                <td><?php echo $x->sks; ?></td>
                                <td><input type="checkbox" name="cek"/></td>
                            </tr>
                        <?php endwhile; ?>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><input type="button" value="OK" onClick="isiKRS()"/></td>
                        </tr>
                        </table>
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