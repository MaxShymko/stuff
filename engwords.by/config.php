<?php
	$dblocation = "localhost";
	$dbname = "id3631026_maindb";
	$dbuser = "root";
	$dbpasswd = "";
	$link = mysqli_connect($dblocation,$dbuser,$dbpasswd,$dbname);
	if (!$link) 
	{
	  echo( "<P>В настоящий момент сервер базы данных не доступен, поэтому 
	            корректное отображение страницы невозможно.</P>" );
	  exit();
	}
	if ($result = mysqli_query($link, "")) {
	    $row = mysqli_fetch_row($result);
	    echo "Default database is " . $row[0];
	    mysqli_free_result($result);
	}
?>