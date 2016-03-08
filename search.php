<?session_start();?>
<?if(isset($_SESSION["user"])){
			
		}else{
			header("Location: index.php?err=sessExpi");
			exit();
		}?>
<html>
    <head>
        <title>Vokabel Archivierer</title>
		<meta charset="utf-8">
		 <!--Import Google Icon Font-->
      	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      	<!--Import materialize.css-->
      	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

      	<!--Let browser know website is optimized for mobile-->
      	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="shortcut icon" type="image/png" href="favicon.png">
    </head>
    <body>
		<?include("menu.php");?>
        <article style="margin:15px;">
            <h4>Suche</h4>
			<p id="results"></p>
			<?
			if($_GET["search"]==""){
				?><script>document.getElementById("results").textContent="Kein Suchbegriff vorhanden!"</script><?
			}else{
			$counter=0;
			$found=false;
			$search=$_GET["search"];
			/*echo "SELECT * FROM  `substantive` 
							WHERE  `inf_lat` LIKE  '%".$search."%'
							OR  `gen_lat` LIKE  '%".$search."%'
							OR  `ger` LIKE  '%".$search."%'
							OR  `tags` LIKE  '%".$search."%'
						";*/
			include("config.php");
			$pdo=new PDO('mysql:hostname=localhost;dbname='.$sqldb, $sqluser, $sqlpass);
			echo '<ul class="collection with-header">'; 
			echo '<li class="collection-header" id="subs"><h4>Substantive</h4></li>';
			foreach($pdo->query("SELECT * FROM  `substantive` 
					WHERE  `inf_lat` LIKE  '%".$search."%'
					OR  `gen_lat` LIKE  '%".$search."%'
					OR  `ger` LIKE  '%".$search."%'
					OR  `tags` LIKE  '%".$search."%'
				") as $row){
				echo '
				<li class="collection-item avatar">
					<div id="testbox" class="teal lighten-2 circle" style="width:50px;height:50px;border-radius:25px;">
						<center>
							<font style="color:white;font-family:Roboto;font-size:2em;position:relative;top:13px;">'.$row["lektion"].'</font>
						</center>
					</div>
					<span class="title">'.$row["inf_lat"].'</span>
					<p>'.$row["gen_lat"].', 
					'.$row["genus"].': 
					 '.$row["ger"].'<br>
					 Schlagw&ouml;rter: '.substr(str_replace(";", ", ", $row["tags"]), 0, strlen(str_replace(";", ", ", $row["tags"]))-2).'
					</p>
				</li>
				';
				$counter++;
				$found=true;
			}
			if($found==false){echo '<script>document.getElementById("subs").remove()</script>';}
			$found=false;
			echo '<li class="collection-header" id="verbs"><h4>Verben</h4></li>';
			foreach($pdo->query("SELECT * FROM  `verben` 
					WHERE  `inf_praes` LIKE  '%".$search."%'
					OR  `1_praes` LIKE  '%".$search."%'
					OR  `1_perf` LIKE '%".$search."%'
					OR  `ppp` LIKE '%".$search."%'
					OR  `ger` LIKE  '%".$search."%'
					OR  `tags` LIKE  '%".$search."%'") as $row){
				echo '
				<li class="collection-item avatar">
				<div id="testbox" class="teal lighten-2 circle" style="width:50px;height:50px;border-radius:25px;">
					<center>
						<font style="color:white;font-family:Roboto;font-size:2em;position:relative;top:13px;">'.$row["lektion"].'</font>
					</center>
				</div>
				  <span class="title">'.$row["inf_praes"].'</span>
				  <p>'.$row["1_praes"].', 
					 '.$row["1_perf"].', 
					 '.$row["ppp"].': 
					 '.$row["ger"].'<br>
					 Schlagw&ouml;rter: '.substr(str_replace(";", ", ", $row["tags"]), 0, strlen(str_replace(";", ", ", $row["tags"]))-2).'
				  </p>
				</li>
				';
				$counter++;
				$found=true;
			}
			if($found==false){echo '<script>document.getElementById("verbs").remove()</script>';}
			$found=false;
			echo '<li class="collection-header" id="irr_verbs"><h4>Irreguläre Verben</h4></li>';
			foreach($pdo->query("SELECT * FROM  `irr_verben` 
					WHERE  `inf_praes` LIKE  '%".$search."%'
					OR  `1_praes` LIKE  '%".$search."%'
					OR  `2_praes` LIKE  '%".$search."%'
					OR  `3_praes` LIKE  '%".$search."%'
					OR  `4_praes` LIKE  '%".$search."%'
					OR  `5_praes` LIKE  '%".$search."%'
					OR  `6_praes` LIKE  '%".$search."%'
					OR  `inf_perf` LIKE  '%".$search."%'
					OR  `1_perf` LIKE  '%".$search."%'
					OR  `2_perf` LIKE  '%".$search."%'
					OR  `3_perf` LIKE  '%".$search."%'
					OR  `4_perf` LIKE  '%".$search."%'
					OR  `5_perf` LIKE  '%".$search."%'
					OR  `6_perf` LIKE  '%".$search."%'
					OR  `1_plus` LIKE  '%".$search."%'
					OR  `2_plus` LIKE  '%".$search."%'
					OR  `3_plus` LIKE  '%".$search."%'
					OR  `4_plus` LIKE  '%".$search."%'
					OR  `5_plus` LIKE  '%".$search."%'
					OR  `6_plus` LIKE  '%".$search."%'
					OR  `1_impf` LIKE  '%".$search."%'
					OR  `2_impf` LIKE  '%".$search."%'
					OR  `3_impf` LIKE  '%".$search."%'
					OR  `4_impf` LIKE  '%".$search."%'
					OR  `5_impf` LIKE  '%".$search."%'
					OR  `6_impf` LIKE  '%".$search."%'
					OR  `1_fut` LIKE  '%".$search."%'
					OR  `2_fut` LIKE  '%".$search."%'
					OR  `3_fut` LIKE  '%".$search."%'
					OR  `4_fut` LIKE  '%".$search."%'
					OR  `5_fut` LIKE  '%".$search."%'
					OR  `6_fut` LIKE  '%".$search."%'
					OR  `ger` LIKE  '%".$search."%'
					OR  `tags` LIKE  '%".$search."%'
				") as $row){
				echo '
						<li class="collection-item avatar">
							<div id="testbox" class="teal lighten-2 circle" style="width:50px;height:50px;border-radius:25px;">
								<center>
									<font style="color:white;font-family:Roboto;font-size:2em;position:relative;top:13px;">'.$row["lektion"].'</font>
								</center>
							</div>
							<span class="title">'.$row["inf_praes"].'</span>
							<p>'.$row["1_praes"].', 
							'.$row["1_perf"].': 
							 '.$row["ger"].'<br>
							 Schlagwörter: '.substr(str_replace(";", ", ", $row["tags"]), 0, strlen(str_replace(";", ", ", $row["tags"]))-2).'
							</p>
							<ul class="collapsible" data-collapsible="accordion">
							<li>
								<div class="collapsible-header"><i class="material-icons">today</i>Präsens</div>
								<div class="collapsible-body">
									<ul class="collection">
										<li class="collection-item">Infinitiv: '.$row["inf_praes"].'</li>
										<li class="collection-item">1. Singular: '.$row["1_praes"].'</li>
										<li class="collection-item">2. Singular: '.$row["2_praes"].'</li>
										<li class="collection-item">3. Singular: '.$row["3_praes"].'</li>
										<li class="collection-item">1. Plural: '.$row["4_praes"].'</li>
										<li class="collection-item">2. Plural: '.$row["5_praes"].'</li>
										<li class="collection-item">3. Plural: '.$row["6_praes"].'</li>
									</ul>
								</div>
							</li>
							<li>
								<div class="collapsible-header"><i class="material-icons">query_builder</i>Imperfekt</div>
								<div class="collapsible-body">
									<ul class="collection">
										<li class="collection-item">1. Singular: '.$row["1_impf"].'</li>
										<li class="collection-item">2. Singular: '.$row["2_impf"].'</li>
										<li class="collection-item">3. Singular: '.$row["3_impf"].'</li>
										<li class="collection-item">1. Plural: '.$row["4_impf"].'</li>
										<li class="collection-item">2. Plural: '.$row["5_impf"].'</li>
										<li class="collection-item">3. Plural: '.$row["6_impf"].'</li>
									</ul>
								</div>
							</li>
							<li>
								<div class="collapsible-header"><i class="material-icons">replay</i>Perfekt</div>
								<div class="collapsible-body">
									<ul class="collection">
										<li class="collection-item">Infinitiv: '.$row["inf_perf"].'</li>
										<li class="collection-item">1. Singular: '.$row["1_perf"].'</li>
										<li class="collection-item">2. Singular: '.$row["2_perf"].'</li>
										<li class="collection-item">3. Singular: '.$row["3_perf"].'</li>
										<li class="collection-item">1. Plural: '.$row["4_perf"].'</li>
										<li class="collection-item">2. Plural: '.$row["5_perf"].'</li>
										<li class="collection-item">3. Plural: '.$row["6_perf"].'</li>
									</ul>
								</div>
							</li>
							<li>
								<div class="collapsible-header"><i class="material-icons">restore</i>Plusquamperfekt</div>
								<div class="collapsible-body">
									<ul class="collection">
										<li class="collection-item">1. Singular: '.$row["1_plus"].'</li>
										<li class="collection-item">2. Singular: '.$row["2_plus"].'</li>
										<li class="collection-item">3. Singular: '.$row["3_plus"].'</li>
										<li class="collection-item">1. Plural: '.$row["4_plus"].'</li>
										<li class="collection-item">2. Plural: '.$row["5_plus"].'</li>
										<li class="collection-item">3. Plural: '.$row["6_plus"].'</li>
									</ul>
								</div>
							</li>
							<li>
								<div class="collapsible-header"><i class="material-icons">skip_next</i>Futur</div>
								<div class="collapsible-body">
									<ul class="collection">
										<li class="collection-item">1. Singular: '.$row["1_fut"].'</li>
										<li class="collection-item">2. Singular: '.$row["2_fut"].'</li>
										<li class="collection-item">3. Singular: '.$row["3_fut"].'</li>
										<li class="collection-item">1. Plural: '.$row["4_fut"].'</li>
										<li class="collection-item">2. Plural: '.$row["5_fut"].'</li>
										<li class="collection-item">3. Plural: '.$row["6_fut"].'</li>
									</ul>
								</div>
							</li>
						</li>
						';
				$counter++;
				$found=true;
			}
			if($found==false){echo '<script>document.getElementById("irr_verbs").remove()</script>';}
			$found=false;
			foreach($pdo->query("SELECT * FROM  `adjektive` 
					WHERE  `m` LIKE  '%".$search."%'
					OR  `f` LIKE  '%".$search."%'
					OR  `n` LIKE  '%".$search."%'
					OR  `ger` LIKE  '%".$search."%'
					OR  `tags` LIKE  '%".$search."%'
				") as $row){
				echo '
				<li class="collection-item avatar">
				<div id="testbox" class="teal lighten-2 circle" style="width:50px;height:50px;border-radius:25px;">
					<center>
						<font style="color:white;font-family:Roboto;font-size:2em;position:relative;top:13px;">'.$row["lektion"].'</font>
					</center>
				</div>
				  <span class="title">'.$row["m"].'</span>
				  <p>'.$row["f"].', 
					 '.$row["n"].': 
					 '.$row["ger"].'<br>
					 Schlagw&ouml;rter: '.substr(str_replace(";", ", ", $row["tags"]), 0, strlen(str_replace(";", ", ", $row["tags"]))-2).'
				  </p>
				</li>
				';
				$counter++;
				$found=true;
			}
			if($found==false){echo '<script>document.getElementById("adj").remove()</script>';}
			$found=false;
			echo '<li class="collection-header" id="kln"><h4>Kleine W&ouml;rter</h4></li>';
			foreach($pdo->query("SELECT * FROM  `kleine` 
					WHERE  `lat` LIKE  '%".$search."%'
					OR  `ger` LIKE  '%".$search."%'
					OR  `tags` LIKE  '%".$search."%'
				") as $row){
				echo '
				<li class="collection-item avatar">
				<div id="testbox" class="teal lighten-2 circle" style="width:50px;height:50px;border-radius:25px;">
					<center>
						<font style="color:white;font-family:Roboto;font-size:2em;position:relative;top:13px;">'.$row["lektion"].'</font>
					</center>
				</div>
				  <span class="title">'.$row["lat"].'</span>
				  <p>'.$row["ger"].'<br>
					 Schlagw&ouml;rter: '.substr(str_replace(";", ", ", $row["tags"]), 0, strlen(str_replace(";", ", ", $row["tags"]))-2).'
				  </p>
				</li>
				';
				$counter++;
				$found=true;
			}
			if($found==false){echo '<script>document.getElementById("kln").remove()</script>';}
			$found=false;
			echo "</ul>";
			if($counter==1){
				echo '<script>document.getElementById("results").textContent="Es wurde 1 Suchergebnis gefunden."</script>';
			}else{
				echo '<script>document.getElementById("results").textContent="Es wurden '.$counter.' Suchergebnisse gefunden."</script>';
			}
			}
			?>
        </article>
    </body>
</html>