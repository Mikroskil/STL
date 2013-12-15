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
            $("#article-menu").load("cloud.php #PilihanInput");
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
        function menujuKe(a){
            if(a == "Mata Kuliah")
                $("#article-konten").load("cloud.php #FormInputMatkul");
            else if(a == "Dosen")
                $("#article-konten").load("cloud.php #FormInputDosen");
            else if(a == "Jadwal Kuliah")
                $("#article-konten").load("cloud.php #FormInputJadwal");
        }
        function back(){
            $("#article-menu").load("cloud.php #PilihanInput");
        }
        function kirimMatkul(){
            $.post("insidious.php",
            {
                pin: "2",
                kode: $("#kode-matkul").val(),
                matkul: $("#matkul").val(),
                pilSem: pilSemester.options[pilSemester.selectedIndex].text,
                pilSks: pilSks.options[pilSks.selectedIndex].text
            },
            function(data,status){
                $("#article-konten").load("cloud.php #sukses-input");
            });
        }
        function kirimDosen(){
            $.post("insidious.php",
            {
                pin: "3",
                nip: $("#nip-dosen").val(),
                nama: $("#nama-dosen").val()
            },
            function(data,status){
                $("#article-konten").load("cloud.php #sukses-input");
            });
        }
        function kirimJadwal(){
            $.post("insidious.php",
            {
                pin: "4",
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
                $("#article-konten").load("cloud.php #sukses-input");
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
                        <li><a href="biodata.php" class="sedang-dibuka">Input</a></li>
                        <li><a href="krs.php">Edit</a></li>
                        <li><a href="jadwalp.php">Delete</a></li>
                    <?php }else{ ?>
                        <li><a href="home.php">Home</a></li>
                        <li><a href="biodata.php" class="sedang-dibuka">Biodata</a></li>
                        <li><a href="krs.php">Krs</a></li>
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
                <div id="main-content"></div>
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