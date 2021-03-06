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
    <title>Jadwal</title>
    <script>
		$(document).ready(function(){
            $("#tombol-login").click(function(){
                goToInsidious();
            });
            $("#password").keypress(function(e) {
                if(e.which == 13)
                    goToInsidious();
            });
        });
        function goToInsidious(){
            $.post("insidious.php",
            {
                pin: "1",
                username: $("#username").val(),
                password: $("#password").val()
            },
            function(data, status){
                $("#pesan-login").html(data);
                if(data == "Anda telah login sebagai Mahasiswa" || data == "Anda telah login sebagai Admin"){
                    $("#pesan-tunggu").html("Menuju halaman utama dalam 5 detik");
                    setTimeout(function(){ window.location = "home.php"; }, 5000);
                }
            });
        }
	</script>
</head>
<body>
    <?php if(isset($akses))
        header("Location: home.php");
    else{ ?>
        <div id="wrapper">
            <header>
                <h1>WPK (Website Penjadwalan Kuliah)</h1>
            </header>
            <div id="center">
                <article>
                    <br/><br/><br/><br/><br/><br/>
                    <h3>Isi KRS</h3>
                    <p>Mengisi KRS sesuai dengan mata kuliah yang akan di ambil</p>
                    <h3>Melihat Jadwal Kuliah</h3>
                    <p>Melihat jadwal kuliah sesuai dengan mata kuliah yang diambil</p>
                    <h3>Mengelola Jadwal bagi admin</h3>
                    <p>user interface yang mudah bagi admin untuk mengelola jadwal</p>
                </article>
                <section>
                    <br/><br/>
                    <div id="pesan-login"></div>
                    <div id="pesan-tunggu"></div>
                    <br/><br/>
                    <label>Username</label>
                    <input type="text" class="form-control" placeholder="nim" id="username"/>
                    <br/>
                    <label>Password</label>
                    <input type="password" class="form-control" placeholder="password" id="password">
                    <br/>
                    <button type="button" class="btn btn-default btn-lg" id="tombol-login">Login</button>
                </section>
            </div>
            <div id="push"></div>
        </div>
        <footer>
            <h2><center>Copyright &copy; STL 2013-2014 </center></h2>
        </footer>
    <?php } ?>
</body>
</html>