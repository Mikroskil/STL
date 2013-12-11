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
		$pilSem = $_POST["pilSem"];
		$pilSks = $_POST["pilSks"];
		$save = mysql_query("INSERT INTO matakuliah VALUES ('$kode', '$matkul', '$pilSem', '$pilSks')");
	}
	else if($pin == "3"){
		$nip = $_POST["nip"];
		$nama = $_POST["nama"];
		$save = mysql_query("INSERT INTO dosen VALUES ('$nip', '$nama')");
	}
	else if($pin == "4"){
		$waktu = $_POST["waktu"];
		$jurusan = $_POST["jurusan"];
		$semester = $_POST["semester"];
		$kelas = $_POST["kelas"];
		$hari = $_POST["hari"];
		$mulai = $_POST["mulai"];
		$matkul = $_POST["matkul"];
		$dosen = $_POST["dosen"];
		$gedung = $_POST["gedung"];
		$ruangan = $_POST["ruangan"];
		$lantai = $_POST["lantai"];

		$input_jadwal = mysql_query("INSERT INTO jadwal (waktu, jurusan, semester, kelas, hari, mulai, matkul, dosen, gedung, ruangan, lantai) VALUES ('$waktu', '$jurusan', '$semester', '$kelas', '$hari', '$mulai', '$matkul', '$dosen', '$gedung', '$ruangan', '$lantai')");
	}
?>