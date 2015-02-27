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
		<title>Des Moines Adult Hockey - Alien Hockey</title>
		<link href="http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" type="text/css" href="common/style.css" />
	</head>
	<body>
	<?php include ("common/tracking.php");?>
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
						<?php include ("common/recent_scores.php");?>
					</div>
					<div id="content">
						<div id="box1">

<h1>Alien Hockey</h1>
<hr />
<br />
<table id="standings" align="center" width="90%">
<thead>
	<tr>
		<th align="left">First</th>
		<th align="left">Last</th>
		<th>Goals</th>
		<th>Assists</th>
		<th>Points</th>
		<th>PM</th>
	</tr>
</thead>
<tbody>
<?php
	include ("common/db_setup.php");
	$connection = mysqli_connect($server, $username, $password, $database) or die ("Connection failed");
	$query = "SELECT per.first, 
				per.last, 
				ts.goals, 
				ts.assists, 
				(ts.goals + ts.assists) AS points, 
				ts.pen_min
			FROM temp_stats ts
			JOIN player p 
				ON ts.player_id = p.id
			JOIN person per 
				ON p.person = per.id
			WHERE p.team = 2
			ORDER BY per.last, per.first";
	$result = mysqli_query($connection, $query) or die("Query failed");
	while ($row = mysqli_fetch_assoc($result)) {
		$first = $row['first'];
		$last = $row['last'];
		$goals = $row['goals'];
		$assists = $row['assists'];
		$points = $row['points'];
		$pen_min = $row['pen_min'];
		echo "<tr><td align=left><strong>";
		echo htmlentities($first);
		echo "</strong></td><td align=left><strong>";
		echo htmlentities($last);
		echo "</strong></td><td align=center>";
		echo htmlentities($goals);
		echo "</td><td align=center>";
		echo htmlentities($assists);
		echo "</td><td align=center><strong>";
		echo htmlentities($points);
		echo "</strong></td><td align=center>";
		echo htmlentities($pen_min);
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
					<?php include ("common/footer.php");?>
				</div>
			</div>
			<div id="copyright">
				&copy; DMAHockey.com | Design by <a href="http://templated.co" rel="nofollow">TEMPLATED</a>
			</div>
		</div>
	</body>
</html>
