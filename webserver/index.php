<?php
include("database.php");

//https://gist.github.com/rannmann
function toCommunityID($id)
{
	if (preg_match('/^STEAM_/', $id))
	{
		$parts = explode(':', $id);
		return bcadd(bcadd(bcmul($parts[2], '2'), '76561197960265728'), $parts[1]);
	}
	elseif (is_numeric($id) && strlen($id) < 16)
	{
		return bcadd($id, '76561197960265728');
	}
	else
	{
		return $id;
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<!-- Meta -->
		<meta charset="UTF-8">

		<!-- CSS -->
		<link rel="stylesheet" href="style.css">

		<!-- JS -->
		<script src="https://kit.fontawesome.com/9ebd783d08.js" crossorigin="anonymous"></script>

		<!-- Title -->
		<title>[CS:GO] Chat Log</title>
	</head>

	<body>
		<h1 class="title"><a href="index.php">CHAT LOG</a></h1>

		<div class="searchBox">
			<form class="example" action="index.php" method="post">
				<input class="searchInput" id="search" name="search" style="color:white" type="text" placeholder="Search...">
				<button class="searchButton" href="#">
					<i class="fas fa-search"></i>
				</button>
			</form>
		</div>

		<table class="chat-table" id="table">
			<thead>
				<tr>
					<th>Name:</th>
					<th>SteamID:</th>
					<th>Time:</th>
					<th>Message:</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$search = $_POST['search'];

					if (strlen($search) > 0)
					{
						$search = mysqli_real_escape_string($conn, $search);
						$sql = "SELECT * FROM chat_log WHERE CONCAT(date, steamid, name, message) LIKE '%$search%' ORDER BY id DESC";
						$result = mysqli_query($conn, $sql);
					}		

					else
					{
						//Messages per page
						$mpp = 10;

						isset($_GET['page']) ? $page = $_GET['page'] : $page = 0;

						if ($page > 1) {
							$start = ($page * $mpp) - $mpp;
						} else {
							$start = 0;
						}

						$numRows = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM chat_log"));

						$totalPages = $numRows / $mpp;

						$result = mysqli_query($conn, "SELECT * FROM chat_log ORDER BY id DESC LIMIT $start, $mpp");
					}

					if (!is_int($totalPages))
					{
						$totalPages = $totalPages +1;
					}

					if ($_GET['page'] == 0)
					{
						echo "<div class=\"pagination\">Showing page 1 of " . intval($totalPages) . "</div>";
					}
					else 
					{
						echo "<div class=\"pagination\">Showing page " . $_GET['page'] . " of " . intval($totalPages) . "</div>";
					}

					if ($result->num_rows > 0)
					{
						while ($row = $result->fetch_assoc())
						{
							echo "<tr id=\"trsearch\">";
							echo "<td>". htmlentities($row["name"]) . "</td>";
							echo "<td><a href=\"http://steamcommunity.com/profiles/" . toCommunityID($row["steamid"]) . "\" ><span class=\"steamid\">" . $row["steamid"] . "</span></a> </td>";
							echo "<td>" . $row["date"] . "</td>";
							echo "<td><span class=\"embed\">" . htmlentities($row["message"]) . "</span></td>";
							echo "</tr>";
						}
					}
					else
					{
						echo "<tr>";
						echo "<td stlye='text-align: center;'>-</td>";
						echo "<td stlye='text-align: center;'>-</td>";
						echo "<td stlye='text-align: center;'>-</td>";
						echo "<td stlye='text-align: center;'>-</td>";
						echo "</tr>";
					}	
				?>
			</tbody>
		</table>

		<div class="pagination">
			<?php
				if (strlen($search) == 0)
				{
					//Max pages ($totalPages = unlimited)
					$maxPages = 10;

					for ($i = 1; $i <= $maxPages; $i++)
					{
						echo "<a class='letter' href='?page=$i'>&nbsp;$i</a>";
					}
				}
			?>
		</div>

		<div class="footer">
			Coded with ❤️ by <a class="venus" href="https://github.com/ivenuss">venus</a></b>.
		</div>
	</body>
</html>