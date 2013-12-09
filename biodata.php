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
    <script type="text/javascript">
        function matkul(a){
            
            if(a == "Matakuliah"){ 
                document.getElementById('center').innerHTML = '<table><tr><td>Kode</td><td>Matakuliah</td><td>Semester</td><td>Sks</td></tr><tr><td><input type="text"/></td><td><input type="text"/></td><td><select><option>I</option><option>II</option><option>III</option><option>IV</option><option>V</option><option>VI</option><option>VII</option><option>VIII</option></select></td><td><select><option>2</option><option>3</option><option>4</option><option>6</option></select></td><tr><tr><td><input type="button" value="back" onclick="back()"/></td></tr></table>';
            }
            else if(a == "Dosen"){
                document.getElementById('center').innerHTML = '<table><tr><td>Nip</td><td>Nama</td></tr></table><tr><td><input type="text"/></td><td><input type="text"/></td></tr><tr><td><input type="button" value="back" onclick="back()"/></td></tr></table>';
            }
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
        <div id="center">
            <article id="article-home">
                <table>
                    <tr>
                        <td><input type="button" value="Matakuliah" onclick="matkul(this.value)"/></td>
                    </tr>
                    <tr>
                        <td><input type="button" value="Dosen" onclick="matkul(this.value)"/></td>
                    </tr>
                </table>
            </article>
        </div>
    <?php
		}
		else
			header("Location: index.php");
	?>
</body>
</html>