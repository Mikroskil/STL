<?php

	include_once("config.php");
	
	$pin = $_POST["pin"];
	
	if($pin == "1"){
		$username = $_POST["username"];
		$password = $_POST["password"];
		
		$cek_login = mysql_fetch_object(mysql_query("SELECT * FROM akun WHERE username = BINARY '$username'"));
		
		if(isset($cek_login->id)){
			if($cek_login->password == $password){
				$_SESSION['uid'] = $cek_login->id;
				if($cek_login->level == "admin")
					echo "Anda telah login sebagai Admin";
				else
					echo "Anda telah login sebagai Mahasiswa";
			}
			else
				echo "Password salah";
		}
		else
			echo "Username tersebut belum terdaftar";
	}
	else if($pin == "2"){
		$kode = $_POST["kode"];
		$matkul = $_POST["matkul"];
		$save = mysql_query("INSERT INTO `matakuliah`(`kode`, `mtk`, `semester`, `sks`) VALUES ('".$kode."','".$matkul."','b',1)");
	}
	else if($pin == "3"){
		echo $pin;
		$nip = $_POST["nip"];
		$nama = $_POST["nama"];
		$save = mysql_query("INSERT INTO `dosen`(`nip`, `nama`) VALUES ('".$nip."','".$nama."')");
	}
?>