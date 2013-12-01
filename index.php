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
				$.post("insidious.php",
				{
					pin: "1",
					username: $("#username").val(),
					password: $("#password").val()
				},
				function(data, status){
					$("#pesan-login").css('color', 'white');
					$("#pesan-login").css('font-size', 14);
					$("#pesan-login").html(data);
					if(data == "Anda telah login sebagai Mahasiswa"){
						$("#pesan-tunggu").css('color', 'white');
						$("#pesan-tunggu").css('font-size', 14);
						$("#pesan-tunggu").html("Menuju halaman utama dalam 5 detik");
						setTimeout(function(){ window.location = "home.php"; }, 5000);
					}
				});
			});
		});
	</script>
</head>
<body>
	<div id="wrapper">
        <header>
            <h1>This is Header</h1>
        </header>
        <div id="center">
            <article>
                <h2>This is Article</h2>
            </article>
            <section>
                <br/><br/>
                <span id="pesan-login">&nbsp;</span>
                <span id="pesan-tunggu">&nbsp;</span>
                <br/><br/>
                <label>Username</label>
                <input type="text" class="form-control" placeholder="nim" id="username"/>
                <br/>
                <label>Password</label>
                <input type="text" class="form-control" placeholder="password" id="password">
                <br/>
                <button type="button" class="btn btn-default btn-lg" id="tombol-login">Login</button>
            </section>
        </div>
        <div id="push"></div>
    </div>
    <footer>
    	<h2>This is Footer</h2>
    </footer>
</body>
</html>