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
		<title>Des Moines Adult Hockey - Stats</title>
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
						<?php include ("common/recent_scores.php");?>
					</div>
					<div id="content">
						<div id="box1">

<h1>Points Leaders</h1>
<hr />
<br />
<table id="scorers" align="center" width="90%">
<thead>
	<tr>
		<th align=left>First</th>
		<th align=left>Last</th>
		<th align=left>Team</th>
		<th>Goals</th>
		<th>Assists</th>
		<th>Points</th>
	</tr>
</thead>
<tbody>
<?php
	include ("common/db_setup.php");
	$connection = mysqli_connect($server, $username, $password, $database) or die ("Connection failed");
	$query = "SELECT per.first, per.last, tm.name, ts.goals, ts.assists, (
				ts.goals + ts.assists
				) AS points
				FROM temp_stats ts
				JOIN player p ON ts.player_id = p.id
				JOIN person per ON p.person = per.id
				JOIN team tm ON p.team = tm.id
				ORDER BY points DESC , ts.goals DESC , per.last
				LIMIT 10";
	$result = mysqli_query($connection, $query) or die("Query failed");
	while ($row = mysqli_fetch_assoc($result)) {
		$first = $row['first'];
		$last = $row['last'];
		$team = $row['name'];
		$goals = $row['goals'];
		$assists = $row['assists'];
		$points = $row['points'];
		echo "<tr><td align=left><strong>";
		echo htmlentities($first);
		echo "</strong></td><td align=left><strong>";
		echo htmlentities($last);
		echo "</strong></td><td align=left>";
		echo htmlentities($team);
		echo "</td><td align=center>";
		echo htmlentities($goals);
		echo "</td><td align=center>";
		echo htmlentities($assists);
		echo "</td><td align=center><strong>";
		echo htmlentities($points);
		echo "</strong></td></tr>";
	}
	mysqli_free_result($result);
	mysqli_close($connection);
?>
</tbody>
</table>
<br /><br />

<h1>Goon List</h1>
<hr />
<p><em><font size=-1>(Players on the "Goon List" are those who average over a penalty minute per game.)</font></em></p>
<table id="goon" align="center" width="90%">
<thead>
	<tr>
		<th align=left>First</th>
		<th align=left>Last</th>
		<th align=left>Team</th>
		<th>PM</th>
		<th>PM/G</th>
	</tr>
</thead>
<tbody>
<?php
	include ("common/db_setup.php");
	$connection = mysqli_connect($server, $username, $password, $database) or die ("Connection failed");
	$query = "SELECT per.first, per.last, tm.name, ts.pen_min, ROUND( ts.pen_min / gp.gp, 2 ) AS  'pm_per_game'
FROM temp_stats ts
JOIN player p ON ts.player_id = p.id
JOIN person per ON p.person = per.id
JOIN team tm ON p.team = tm.id
JOIN (

SELECT t.name, t.id, COUNT( * ) AS gp
FROM team t
JOIN schedule s ON t.id = s.home
OR t.id = s.away
JOIN game g ON s.id = g.id
WHERE g.special_case IS NOT NULL 
GROUP BY t.name, t.id
) AS gp ON p.team = gp.id
WHERE ts.pen_min > gp.gp
ORDER BY ts.pen_min DESC";
	$result = mysqli_query($connection, $query) or die("Query failed");
	while ($row = mysqli_fetch_assoc($result)) {
		$first = $row['first'];
		$last = $row['last'];
		$team = $row['name'];
		$pen_min = $row['pen_min'];
		$pm_per_game = $row['pm_per_game'];
		echo "<tr><td align=left><strong>";
		echo htmlentities($first);
		echo "</strong></td><td align=left><strong>";
		echo htmlentities($last);
		echo "</strong></td><td align=left>";
		echo htmlentities($team);
		echo "</td><td align=center><strong>";
		echo htmlentities($pen_min);
		echo "</strong></td><td align=center>";
		echo htmlentities($pm_per_game);
		echo "</td></tr>";
	}
	mysqli_free_result($result);
	mysqli_close($connection);
?>
</tbody>
</table>
<br /><br />

<h1>Goalie Rankings</h1>
<hr />
<p><em><font size=-1>(Must have played in at least 4 games to be on the list.)</font></em></p>
<table id="goon" align="center" width="90%">
<thead>
	<tr>
		<th align=left>First</th>
		<th align=left>Last</th>
		<th align=left>Team</th>
		<th>GP</th>
		<th>GA</th>
		<th>GAA</th>
		<th>SO</th>
	</tr>
</thead>
<tbody>
<?php
	include ("common/db_setup.php");
	$connection = mysqli_connect($server, $username, $password, $database) or die ("Connection failed");
	$query = "SELECT per.first, per.last, tm.name, ROUND( tg.games, 1 ) AS games, tg.goals, ROUND( (
				tg.goals / tg.games
				), 2 ) AS  'gaa', tg.shutouts
				FROM temp_goalie tg
				JOIN player p ON tg.player_id = p.id
				JOIN person per ON p.person = per.id
				JOIN team tm ON p.team = tm.id
				ORDER BY  'gaa',  'games'";
	$result = mysqli_query($connection, $query) or die("Query failed");
	while ($row = mysqli_fetch_assoc($result)) {
		$first = $row['first'];
		$last = $row['last'];
		$team = $row['name'];
		$games = $row['games'];
		$goals = $row['goals'];
		$gaa = $row['gaa'];
		$shutouts = $row['shutouts'];
		echo "<tr><td align=left><strong>";
		echo htmlentities($first);
		echo "</strong></td><td align=left><strong>";
		echo htmlentities($last);
		echo "</strong></td><td align=left>";
		echo htmlentities($team);
		echo "</td><td align=center>";
		echo htmlentities($games);
		echo "</td><td align=center>";
		echo htmlentities($goals);
		echo "</td><td align=center><strong>";
		echo htmlentities($gaa);
		echo "</strong></td><td align=center>";
		echo htmlentities($shutouts);
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
