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
		$save = mysql_query("INSERT INTO matakuliah (kode, mtk, semester, sks) VALUES ('$kode', '$matkul', '$pilSem', '$pilSks')");
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

        $q = mysql_fetch_object(mysql_query("SELECT * FROM matakuliah WHERE mtk = '$matkul'"));

        $t = $q->sks;
        $r = $q->kode;

		$input_jadwal = mysql_query("INSERT INTO jadwal (kode, sks, waktu, jurusan, semester, kelas, hari, mulai, matkul, dosen, gedung, ruangan, lantai) VALUES ('$r', '$t', '$waktu', '$jurusan', '$semester', '$kelas', '$hari', '$mulai', '$matkul', '$dosen', '$gedung', '$ruangan', '$lantai')");
	}
	
	else if($pin == "5"){
		$id = $_POST["id"];
		$save = mysql_query("DELETE FROM matakuliah WHERE id = '$id'");
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
        <td colspan="2"><input type="button" value="Submit" onclick="menujuKeFormDosenEditUpdate('.$q->id.')"/></td>
    </tr>
</table>';
	}
	else if($pin == "7"){
		$id = $_POST["id"];
		$nip = $_POST["nip"];
		$nama = $_POST["nama"];
		$q = mysql_query("UPDATE dosen SET nip='$nip', nama='$nama' WHERE id=$id");
	}
	else if($pin == "8"){
		$id = $_POST["id"];
		$q = mysql_fetch_object(mysql_query("SELECT * FROM matakuliah WHERE id = $id"));
		echo '
		<table id="FormEditMatkulSingle"><tr><td>Kode</td><td>Matakuliah</td><td>Semester</td><td>Sks</td></tr><tr><td><input type="text" id ="kode-matkul" value="'.$q->kode.'"/></td><td><input type="text" id ="matkul" value="'.$q->mtk.'"/></td><td>'.$q->semester.'&nbsp;<select id="pilSemester"><option>I</option><option>II</option><option>III</option><option>IV</option><option>V</option><option>VI</option><option>VII</option><option>VIII</option></select></td><td>'.$q->sks.'&nbsp;<select id="pilSks"><option>2</option><option>3</option><option>4</option><option>6</option></select></td></tr><tr><td colspan="4"><input type="button" id="submit-matkul" value="submit" onclick="menujuKeFormMatkulEditUpdate('.$q->id.')"/></td></tr></table>

		';
	}
	else if($pin == "9"){
		$id = $_POST["id"];
		$kode = $_POST["kode"];
		$matkul = $_POST["matkul"];
		$pilSem = $_POST["pilSem"];
		$pilSks = $_POST["pilSks"];
		$q = mysql_query("UPDATE matakuliah SET kode='$kode', mtk='$matkul', semester='$pilSem', sks='$pilSks' WHERE id=$id");
	}
    else if($pin == "11"){
        $id = $_POST["id"];
        $gender = $_POST["gender"];
        $alamat = $_POST["alamat"];
        $nomor = $_POST["nomor"];
        $q = mysql_query("UPDATE akun SET gender='$gender', alamat='$alamat', nomor='$nomor' WHERE id=$id");
    }
	else if($pin == "10"){
		$id = $_POST["id"];
		$q = mysql_fetch_object(mysql_query("SELECT * FROM jadwal WHERE id = $id"));
	echo '<table>
	<tr>
        <td>Waktu</td>
        <td>'.$q->waktu.'&nbsp;
            <select id="waktuJ">
                <option>Pagi</option>
                <option>Sore</option>
            </select>
        </td>
    </tr>
    <tr>
    	<td>Jurusan</td>
        <td>'.$q->jurusan.'&nbsp;
        	<select id="jurusanJ">
				<option>TI</option>
			</select>
        </td>
    </tr>
    <tr>
    	<td>Semester</td>
        <td>'.$q->semester.'&nbsp;
        	<select id="semesterJ">
				<option>V</option>
			</select>
        </td>
    </tr>
    <tr>
    	<td>Kelas</td>
        <td>'.$q->kelas.'&nbsp;
        	<select id="kelasJ">
                <option>A</option>
                <option>B</option>
                <option>C</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Hari</td>
        <td>'.$q->hari.'&nbsp;
            <select id="hariJ">
                <option>Senin</option>
                <option>Selasa</option>
                <option>Rabu</option>
                <option>Kamis</option>
                <option>Jumat</option>
                <option>Sabtu</option>
            </select>
        </td>
    </tr>
    <tr>
    	<td>Jam Mulai</td>
        <td>'.$q->mulai.'&nbsp;
        	<select id="mulaiJ">
				<option>I</option>
    			<option>II</option>
    			<option>III</option>
			</select>
        </td>
    </tr>
    <tr>
    	<td>Mata Kuliah</td>
        <td>'.$q->matkul.'&nbsp;
        	<select id="matkulJ">';
            $query = mysql_query("SELECT * FROM matakuliah");
            while($x = mysql_fetch_object($query)):
                echo '<option>'.$x->mtk.'</option>';
            endwhile;
            echo '</select>
        </td>
    </tr>
    <tr>
    	<td>Nama Dosen</td>
    	<td>'.$q->dosen.'&nbsp;
        	<select id="dosenJ">';
            $quer = mysql_query("SELECT * FROM dosen");
            while($x = mysql_fetch_object($quer)):
            
                echo '<option>'.$x->nama.'</option>';
            endwhile;
            echo '</select>
        </td>
    </tr>
    <tr>
    	<td>Ruangan</td>
    	<td>
        	Gedung &nbsp;'.$q->gedung.'&nbsp;
        	<select id="gedungJ">
				<option>B</option>
    			<option>C</option>
			</select>
        	T &nbsp;'.$q->ruangan.'&nbsp;
        	<select id="ruanganJ">
				<option>1</option>
    			<option>2</option>
    			<option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
			</select>
            L &nbsp;'.$q->lantai.'&nbsp;
        	<select id="lantaiJ">
				<option>1</option>
    			<option>2</option>
    			<option>3</option>
                <option>4</option>
                <option>5</option>
			</select>
        </td>
    </tr>
    <tr>
    	<td colspan="2">
            <input type="button" value="Submit" onclick="menujuKeFormJadwalEditUpdate('.$q->id.')"/>
        </td>
    </tr>
</table>';
	}
?>