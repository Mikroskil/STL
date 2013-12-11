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
        function menujuKe(a){
            if(a == "Matakuliah"){ 
                document.getElementById('main-content').innerHTML = '<table><tr><td>Kode</td><td>Matakuliah</td><td>Semester</td><td>Sks</td></tr><tr><td><input type="text" id ="kode-matkul"/></td><td><input type="text" id ="matkul"/></td><td><select id="pilSemester"><option>I</option><option>II</option><option>III</option><option>IV</option><option>V</option><option>VI</option><option>VII</option><option>VIII</option></select></td><td><select id="pilSks"><option>2</option><option>3</option><option>4</option><option>6</option></select></td></tr><tr><td><input type="button" id="submit-matkul" value="submit" onclick="kirimMatkul()"/><input type="button" value="back" onclick="back()"/></td></tr></table>';
            }
            else if(a == "Dosen"){
                document.getElementById('main-content').innerHTML = '<table><tr><td>Nip</td><td>Nama</td></tr><tr><td><input type="text" id ="nip-dosen"/></td><td><input type="text" id ="nama-dosen"/></td></tr><tr><td><input type="button" id="submit-dosen" value="submit" onclick="kirimDosen()"/><input type="button" value="back" onclick="back()"/></td></tr></table>';
            }
            else if(a == "JadwalKuliah")
                $("#main-content").load("cloud.html #FormInputJadwal");
        }
        function back(){
            document.getElementById('main-content').innerHTML = '<table><tr><td><input type="button" value="Matakuliah" onclick="menujuKe(this.value)"/></td></tr><tr><td><input type="button" value="Dosen" onclick="menujuKe(this.value)"/></td></tr></table>'
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
                document.getElementById('main-content').innerHTML = '<table><tr><td><input type="button" value="Matakuliah" onclick="matkul(this.value)"/></td></tr><tr><td><input type="button" value="Dosen" onclick="matkul(this.value)"/></td></tr></table>'
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
                document.getElementById('main-content').innerHTML = '<table><tr><td><input type="button" value="Matakuliah" onclick="matkul(this.value)"/></td></tr><tr><td><input type="button" value="Dosen" onclick="matkul(this.value)"/></td></tr></table>'
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
                <div id="main-content">
                    <table>
                        <tr>
                            <td><input type="button" value="Matakuliah" onClick="menujuKe(this.value)"/></td>
                        </tr>
                        <tr>
                            <td><input type="button" value="Dosen" onClick="menujuKe(this.value)"/></td>
                        </tr>
                        <tr>
                            <td><input type="button" value="JadwalKuliah" onClick="menujuKe(this.value)"/></td>
                        </tr>
                    </table>
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