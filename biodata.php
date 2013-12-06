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
	<title>Home</title>
</head>
<body>
	<?php if(isset($akses)){ ?>
        <header>
            <nav>
                <ul>
                    <?php if(isset($akses->level) === "admin"){ ?>
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
                <h2>This is Article</h2>
            </article>
        </div>
    <?php
		}
		else
			header("Location: index.php");
	?>
</body>
</html>