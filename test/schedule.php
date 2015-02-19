<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--

	Design by TEMPLATED
	http://templated.co
	Released for free under the Creative Commons Attribution License

	Name       : Nameless Geometry
	Version    : 1.0
	Released   : 20130222

-->
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta name="keywords" content="" />
		<meta name="description" content="" />
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Des Moines Adult Hockey - Schedule</title>
		<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="common/style.css" />
	</head>
	<body>
		<div id="bg">
			<div id="outer">
				<div id="header">
				<?php include ("common/header.php");?>
				</div>
				<div id="main">
					<div id="sidebar1">
						<?php include ("common/teams.php");?>
					</div>
					<div id="sidebar2">
						<h3>
							Recent Scores
						</h3>
						<ul class="linkedList">
							<li class="first">
								<a href="#">FoDM/KB - 5<br />Red Alert - 8</a>
							</li>
							<li>
								<a href="#">Ichi - 3<br />Alien - 5</a>
							</li>
							<li>
								<a href="#">Kryptonite - 3<br />Rink Rats - 2</a>
							</li>
							<li class="last">
								<a href="#">Victors - 5<br />Flying Moose - 3</a>
							</li>
						</ul>
						<h3>
							Etiam hendrerit
						</h3>
						<img class="top" src="images/pic2.jpg" width="252" height="80" alt="" />
						<p>
							Turpis placerat lectus quis consequat tincidunt felis. Fermentum et purus mollis posuere aliquam 
							commodo sed blandit curae lorem ipsum.
						</p>
					</div>
					<div id="content">
						<div id="box1">
<h1>2014-15 Schedule</h1>
<hr />
<br />
<table id="schedule" align="center" width="95%">

<thead>
	<tr>
		<th>Date</th>
		<th>Time</th>
		<th>Home Team</th>
		<th>Away Team</th>
		<th>Score</th>
	</tr>
</thead>
<tbody>
<?php
	include ("common/db_setup.php");
	$connection = mysqli_connect($server, $username, $password, $database) or die ("Connection failed");
	$query = "select date_format(sched.date,'%c/%e/%y') as 'date', time_format(sched.time,'%h:%i %p') as 'time', team1.name as 'home', team2.name as 'away', g.special_case as 'outcome', g.home_score as 'home_score', g.away_score as 'away_score' from schedule sched join team team1 on sched.home = team1.id join team team2 on sched.away = team2.id left join game g on g.id = sched.id";
	$result = mysqli_query($connection, $query) or die("Query failed");
	while ($row = mysqli_fetch_assoc($result)) {
		$date = $row['date'];
		$time = $row['time'];
		$home = $row['home'];
		$away = $row['away'];
		$outcome = $row['outcome'];
		$home_score = $row['home_score'];
		$away_score = $row['away_score'];
		echo "<tr><td align=center>";
		echo htmlentities($date);
		echo "</td><td align=center>";
		echo htmlentities($time);
		echo "</td><td align=center>";
		if ($home_score > $away_score || $outcome == 'A_SOL' || $outcome == 'A_FOR') {
			echo "<strong>";
			echo htmlentities($home);
			echo "</strong>";
		}
		else
		{
			echo htmlentities($home);
		}
		echo "</td><td align=center>";
		if ($home_score < $away_score || $outcome == 'H_SOL' || $outcome == 'H_FOR') {
			echo "<strong>";
			echo htmlentities($away);
			echo "</strong>";
		}
		else
		{
			echo htmlentities($away);
		}
		echo "</td><td align=center>";
		if (is_null($outcome))
		{
			echo "";
		}
		else
		{
			echo htmlentities($home_score);
			echo " - ";
			echo htmlentities($away_score);
			if ($outcome == 'H_SOL' || $outcome == 'A_SOL') 
			{
				echo " (SO)";
			}
			if ($outcome == 'H_FOR' || $outcome == 'A_FOR') 
			{
				echo " (F)";
			}
		}
		echo "</td></tr>";
	}
	mysqli_free_result($result);
	mysqli_close($connection);
?>
</tbody>
</table>

							<p>
								
							</p>
						</div>
						
						<br class="clear" />
					</div>
					<br class="clear" />
				</div>
				<div id="footer">
					<div id="footerContent">
						<h3>
							Fringilla integer morbi
						</h3>
						<p>
							Duis rhoncus aenean fusce ornare. Dolor velit augue proin pellentesque. Semper purus orci vivamus. 
							Tempus nullam praesent sem ipsum. Sapien nibh aliquam convallis vestibulum. Lorem elit sapien duis 
							et cras. Nunc feugiat sed praesent amet lobortis semper tellus. Lobortis sodales nisi feugiat. 
							Cubilia sollicitudin metus ut lectus ante. Aliquam condimentum faucibus velit, sit amet molestie 
							dolor euismod non. Integer nec sapien turpis. Quisque volutpat aliquet tortor sit amet laoreet. 
							Phasellus posuere rutrum lacus, id vestibulum metus dictum id. Curabitur dictum ullamcorper 
							bibendum. Phasellus quam justo. Sed vitae placerat dolor. Vivamus ultrices congue auctor. 
							Pellentesque sit amet posuere libero.
						</p>
					</div>
					<div id="footerSidebar">
						<h3>
							Consequat metus
						</h3>
						<ul class="linkedList">
							<li class="first">
								<a href="#">Vestibulum lacinia nisl dolore</a>
							</li>
							<li>
								<a href="#">Tristique amet sodales aliquam</a>
							</li>
							<li class="last">
								<a href="#">Tellus et volutpat sed etiam</a>
							</li>
						</ul>
					</div>
					<br class="clear" />
				</div>
			</div>
			<div id="copyright">
				&copy; DMAHockey.com | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>
			</div>
		</div>
	</body>
</html>
