<?php

    include_once("config.php");

?>

<table id="PilihanInput">
    <tr>
        <td><input type="button" value="Mata Kuliah" onClick="menujuKe(this.value)"/></td>
    </tr>
    <tr>
        <td><input type="button" value="Dosen" onClick="menujuKe(this.value)"/></td>
    </tr>
    <tr>
        <td><input type="button" value="Jadwal Kuliah" onClick="menujuKe(this.value)"/></td>
    </tr>
</table>

<table id="FormInputMatkul"><tr><td>Kode</td><td>Matakuliah</td><td>Semester</td><td>Sks</td></tr><tr><td><input type="text" id ="kode-matkul"/></td><td><input type="text" id ="matkul"/></td><td><select id="pilSemester"><option>I</option><option>II</option><option>III</option><option>IV</option><option>V</option><option>VI</option><option>VII</option><option>VIII</option></select></td><td><select id="pilSks"><option>2</option><option>3</option><option>4</option><option>6</option></select></td></tr><tr><td><input type="button" id="submit-matkul" value="submit" onclick="kirimMatkul()"/><input type="button" value="back" onclick="back()"/></td></tr></table>

<table id="FormInputDosen"><tr><td>Nip</td><td>Nama</td></tr><tr><td><input type="text" id ="nip-dosen"/></td><td><input type="text" id ="nama-dosen"/></td></tr><tr><td><input type="button" id="submit-dosen" value="submit" onclick="kirimDosen()"/><input type="button" value="back" onclick="back()"/></td></tr></table>

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
            <input type="button" value="back" onclick="back()"/>
        </td>
    </tr>
</table>