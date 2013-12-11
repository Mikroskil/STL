    <table><tr><td>Nip</td><td>Nama</td></tr><tr><td><input type="text" id ="nip-dosen"/></td><td><input type="text" id ="nama-dosen"/></td></tr><tr><td><input type="button" id="submit-dosen" value="submit" onclick="kirimDosen()"/><input type="button" value="back" onclick="back()"/></td></tr></table>

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
                <option><?php echo $x->mtk . "&nbsp;"; ?></option>
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
                <option><?php echo $x->nama . "&nbsp;"; ?></option>
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
            <input type="button" value="Submit" onclick="hitung()"/>
            <input type="button" value="back" onclick="back()"/>
        </td>
    </tr>
</table>