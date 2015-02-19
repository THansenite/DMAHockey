<html>
<head>
	<title>DMAHockey.com - Schedule</title>
	<link href="common/styles.css" rel="stylesheet">
</head>
<body>

<h1>2014-15 Schedule</h1>
<table border="1" cellpadding="4px">
<thead>
	<tr>
		<th>Date</th>
		<th>Time</th>
		<th>Home Team</th>
		<th>Away Team</th>
	</tr>
</thead>
<tbody>
<?php
	include ("common/db_setup.php");
	$connection = mysqli_connect($server, $username, $password, $database) or die ("Connection failed");
	$query = "select date_format(sched.date,'%c/%e/%y') as 'date', time_format(sched.time,'%h:%i %p') as 'time', team1.name as 'home', team2.name as 'away' from schedule sched	join team team1	on sched.home = team1.id join team team2 on sched.away = team2.id";
	$result = mysqli_query($connection, $query) or die("Query failed");

	while ($row = mysqli_fetch_assoc($result)) {
		$date = $row['date'];
		$time = $row['time'];
		$home = $row['home'];
		$away = $row['away'];

		echo "<tr><td align=center>";
		echo htmlentities($date);
		echo "</td><td align=center>";
		echo htmlentities($time);
		echo "</td><td align=center>";
		echo htmlentities($home);
		echo "</td><td align=center>";
		echo htmlentities($away);
		echo "</td></tr>";
	}
	mysqli_free_result($result);
	mysqli_close($connection);
?>
</tbody>
</table>

</body>
</html>