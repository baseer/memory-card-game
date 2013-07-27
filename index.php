<?php
require_once("game-api.php"); // Game API will ensure there is a game in session.
?><!DOCTYPE html>
<html>
<head>
	<title>Memory Card Game</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<script src="js/jquery-1.10.2.min.js"></script>
	<script src="js/game.js"></script>
</head>
<body>
<?php include "game-container.php"; ?>
</body>
</html>