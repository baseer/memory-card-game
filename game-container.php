<?php
require_once("game-api.php"); // Game API will ensure there is a game in session.
$game = $_SESSION['Game']; // Use the game from session.

$cards = $game->getCards();
?><div id="gameContainer">
	<div id="cards"><?php
		foreach ($cards as $i=>$card){
			if ($i % GAME::WIDTH == 0){
				echo "<br />";
			}

			$isSolved = $card->isSolved();
			?><div class="card <?php if ($isSolved){echo 'solved';} ?>" data-card="<?php echo $i; ?>">
				<?php
				// Only output the img of the card if it hasn't been solved yet.
				if (!$isSolved){
					$imageUrl = $card->getImageUrl();
					?><img src="<?php echo $imageUrl; ?>" alt="Card" /><?php
				} ?>
			</div><?php
		}
		?>
	</div>
	<a id="newGameLink" href="#">New Game</a>
</div>