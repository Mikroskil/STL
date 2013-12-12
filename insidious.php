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
		$save = mysql_query("INSERT INTO dosen (nip, nama) VALUES ('$nip', '$nama')");
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
	
	else if($pin == "5"){
		$id_matkul = $_POST["id_matkul"];
		$save = mysql_query("DELETE FROM `matakuliah` WHERE `Kode` = '$id_matkul'");
		echo $id_matkul;
	}
	else if($pin == "6"){
		$nip = $_POST["nip"];
		$q = mysql_fetch_object(mysql_query("SELECT * FROM dosen WHERE nip = '$nip'"));
		echo '<table id="FormEditDosenSingle">
    <tr>
        <td>Nip</td>
        <td>Nama</td>
    </tr>
        
        <tr><td><input type="text" id="nip-dosen" value="'.$q->nip.'"/></td><td><input type="text" id="nama-dosen" value="'.$q->nama.'"/></td></tr>
    <tr>
        <td colspan="2"><input type="button" value="Submit" onclick="menujuKeFormEditUpdate('.$q->id.')"/><input type="button" value="back" onclick="back()"/></td>
    </tr>
</table>';
	}
	else if($pin == "7"){
		$id = $_POST["id"];
		$nip = $_POST["nip"];
		$nama = $_POST["nama"];
		echo "asd";
		$q = mysql_query("UPDATE dosen SET nip='$nip', nama='$nama' WHERE id=$id");
	}
?>