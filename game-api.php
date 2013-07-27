<?php
/*
This Game API acts as a bridge between AJAX requests on the front-end and manipulating
the game state on the back-end.

Actions available:
1. To play a pair of cards and see if they match, make a GET request to:
		/game-api.php?action=play-pair&card1=<First Card ID>&card2=<Second Card ID>

   where <First Card ID> is the id of the card, which can be found in the data-card
   attribute of each <div class="card"> in game-container.php.
   And similarly for <Second Card ID>.

2. To reset the game, make a GET request to:
		/game-api.php?action=new-game


All actions return the contents of game-container.php (containing HTML) which can be used
to refresh the front-end.
*/
require_once("Game.php");

/*
Check if there is already a game in session. If there is, use it.
Otherwise, create a new game.
*/
session_start();
if (!isset($_SESSION['Game'])){
	$Game = new Game();
	$_SESSION['Game'] = $Game;
}
else {
	$Game = $_SESSION['Game'];
}

/*
Check which action was requested, and call the appropriate method to handle it.
*/
if (isset($_GET['action'])){
	$action = $_GET['action'];

	if ($action == "play-pair"){
		playPair($_GET['card1'], $_GET['card2']);
	}
	if ($action == "new-game"){
		newGame();
	}
}

/**
  * Play a pair of cards.
  */
function playPair($card1, $card2){
	global $Game;
	$Game->updateStateFromAction($card1, $card2);
	include "game-container.php";
}

/**
  * Reset the game.
  */
function newGame(){
	global $Game;
	$Game = new Game();
	$_SESSION['Game'] = $Game;
	include "game-container.php";
}