<?php

    include_once("config.php");

?><head>
	<link rel="stylesheet" href="bootstrap.css">
    <link rel="stylesheet/less" type="text/css" href="styles.less"/>
    <script src="less-1.5.0.min.js" type="text/javascript"></script>
    <script src="jquery-1.10.2.js" type="text/javascript"></script>
</head>

<div id="PilihanInput">
    <ul>
        <li><div class="metro" onClick="menujuKe('Mata Kuliah')">Mata Kuliah</div></li>
        <li><div class="metro" onClick="menujuKe('Dosen')">Dosen</div></li>
        <li><div class="metro"onClick="menujuKe('Jadwal Kuliah')">Jadwal Kuliah</div></li>
    </ul>
</div>

<div id="PilihanEdit">
    <ul>
        <li><div class="metro" onClick="menujuKe('Mata Kuliah')">Mata Kuliah</div></li>
        <li><div class="metro" onClick="menujuKe('Dosen')">Dosen</div></li>
        <li><div class="metro"onClick="menujuKe('Jadwal Kuliah')">Jadwal Kuliah</div></li>
    </ul>
</div>

<table id="FormInputMatkul"><tr><td>Kode</td><td>Matakuliah</td><td>Semester</td><td>Sks</td></tr><tr><td><input type="text" id ="kode-matkul"/></td><td><input type="text" id ="matkul"/></td><td><select id="pilSemester"><option>I</option><option>II</option><option>III</option><option>IV</option><option>V</option><option>VI</option><option>VII</option><option>VIII</option></select></td><td><select id="pilSks"><option>2</option><option>3</option><option>4</option><option>6</option></select></td></tr><tr><td colspan="4"><input type="button" id="submit-matkul" value="submit" onclick="kirimMatkul()"/></td></tr></table>

<table id="FormInputDosen"><tr><td>Nip</td><td>Nama</td></tr><tr><td><input type="text" id ="nip-dosen"/></td><td><input type="text" id ="nama-dosen"/></td></tr><tr><td colspan="2"><input type="button" id="submit-dosen" value="submit" onclick="kirimDosen()"/></td></tr></table>

<table align="center" id="FormInputJadwal" border="1">
	<tr>
        <td>Waktu</td>
        <td>
            <select id="waktuJ">
                <option>Pagi</option>
                <option>Sore</option>
            </select>
        </td>
    </tr>
    <tr>
    	<td>Jurusan</td>
        <td>
        	<select id="jurusanJ">
				<option>TI</option>
			</select>
        </td>
    </tr>
    <tr>
    	<td>Semester</td>
        <td>
        	<select id="semesterJ">
				<option>V</option>
			</select>
        </td>
    </tr>
    <tr>
    	<td>Kelas</td>
        <td>
        	<select id="kelasJ">
                <option>A</option>
                <option>B</option>
                <option>C</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Hari</td>
        <td>
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
        <td>
        	<select id="mulaiJ">
				<option>I</option>
    			<option>II</option>
    			<option>III</option>
			</select>
        </td>
    </tr>
    <tr>
    	<td>Mata Kuliah</td>
        <td>
        	<select id="matkulJ">
			<?php 
            $query = mysql_query("SELECT * FROM matakuliah");
            while($x = mysql_fetch_object($query)):
            ?>
                <option><?php echo $x->mtk; ?></option>
            <?php endwhile; ?>
            </select>
        </td>
    </tr>
    <tr>
    	<td>Nama Dosen</td>
    	<td>
        	<select id="dosenJ">
			<?php 
            $query = mysql_query("SELECT * FROM dosen");
            while($x = mysql_fetch_object($query)):
            ?>
                <option><?php echo $x->nama; ?></option>
            <?php endwhile; ?>
            </select>
        </td>
    </tr>
    <tr>
    	<td>Ruangan</td>
    	<td>
        	Gedung
        	<select id="gedungJ">
				<option>B</option>
    			<option>C</option>
			</select>
        	T
        	<select id="ruanganJ">
				<option>1</option>
    			<option>2</option>
    			<option>3</option>
                <option>4</option>
                <option>5</option>
                <option>6</option>
			</select>
            L
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
            <input type="button" value="Submit" onclick="kirimJadwal()"/>
        </td>
    </tr>
</table>

<table id="FormEditDosen">
    <tr>
        <td>Nip</td>
        <td>Nama</td>
        <td>Edit</td>
    </tr>
    <?php 
        $query = mysql_query("SELECT * FROM dosen");
        while($x = mysql_fetch_object($query)):
        ?>
        <?php echo '<tr><td>'.$x->nip.'</td><td>'.$x->nama.'</td><td><input type="button" onclick="menujuKeFormDosenEdit('.$x->nip.')"/></td></tr>'; ?>
    <?php endwhile; ?>
</table>

<table id="FormEditDosenSingle">
    <tr>
        <td>Nip</td>
        <td>Nama</td>
    </tr>
    <?php 
        $query = mysql_query("SELECT * FROM dosen");
        while($x = mysql_fetch_object($query)):
        ?>
        <?php echo '<tr><td>'.$x->nama.'</td><td><input type="button" onclick="menujuKeFormDosenEdit('.$x->nip.')"/></td></tr>'; ?>
    <?php endwhile; ?>
    <tr>
        <td colspan="2"><input type="button" id="submit-dosen" value="submit" onclick="kirimDosen()"/><input type="button" value="back" onclick="back()"/></td>
    </tr>
</table>

<table id="FormEditMatkul">
    <tr>
        <td>Kode</td>
        <td>Matakuliah</td>
        <td>Semester</td>
        <td>Sks</td>
        <td>Edit</td>
    </tr>
    <?php 
        $query = mysql_query("SELECT * FROM matakuliah");
        while($x = mysql_fetch_object($query)):
        ?>
        <?php echo '
        <tr>
            <td>'.$x->kode.'</td>
            <td>'.$x->mtk.'</td>>
            <td>'.$x->semester.'</td>
            <td>'.$x->sks.'</td>
            <td><input type="button" onclick="menujuKeFormMatkulEdit('.$x->id.')"/></td>
        </tr>
        '; ?>
    <?php endwhile; ?>
</table>

<table id="FormEditJadwal">
    <tr>
        <td>Waktu</td>
        <td>Jurusan</td>
        <td>Semester</td>
        <td>Kelas</td>
        <td>Hari</td>
        <td>Jam Mulai</td>
        <td>Mata Kuliah</td>
        <td>Nama Dosen</td>
        <td>Gedung</td>
        <td>Ruangan</td>
        <td>Lantai</td>
        <td>Edit</td>
    </tr>
    <?php 
        $query = mysql_query("SELECT * FROM jadwal");
        while($x = mysql_fetch_object($query)):
        ?>
        <?php echo '
        <tr>
            <td>'.$x->waktu.'</td>
            <td>'.$x->jurusan.'</td>>
            <td>'.$x->semester.'</td>
            <td>'.$x->kelas.'</td>
            <td>'.$x->hari.'</td>
            <td>'.$x->mulai.'</td>
            <td>'.$x->matkul.'</td>
            <td>'.$x->dosen.'</td>
            <td>'.$x->gedung.'</td>
            <td>'.$x->ruangan.'</td>
            <td>'.$x->lantai.'</td>
            <td><input type="button" onclick="menujuKeFormJadwalEdit('.$x->id.')"/></td>
        </tr>
        '; ?>
    <?php endwhile; ?>
</table>

<table id="sukses-input">
    <tr>
        <td>Data berhasil diinput</td>
    </tr>
</table>

<table id="sukses-edit">
    <tr>
        <td>Data berhasil diedit</td>
    </tr>
</table>

<table id="sukses-delete">
    <tr>
        <td>Data berhasil dihapus</td>
    </tr>
</table>

<div id="FormEditBio">
    <table>
    <?php 
    //$x = mysql_fetch_object(mysql_query("SELECT * FROM akun"));
    $akses = mysql_fetch_object(mysql_query("SELECT * FROM akun WHERE id = " . $_SESSION['uid']));
    ?>
        <tr>
            <td>Level</td>
            <td><?php echo $akses->level; ?></td>
        </tr>
        <tr>
            <td>Username</td>
            <td><?php echo $akses->username; ?></td>
        </tr>
        <tr>
            <td>Jenis Kelamin</td>
            <td><input type="text" id ="gender" value="<?php echo $akses->gender; ?>"/></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td><input type="text" id ="alamat" value="<?php echo $akses->alamat; ?>"/></td>
        </tr>
        <tr>
            <td>Nomor</td>
            <td><input type="text" id ="nomor" value="<?php echo $akses->nomor; ?>"/></td>
        </tr>
    </table>
    <input type="button" value="Simpan" onclick="EditBioUpdate(<?php echo $akses->id; ?>)" />
</div>