$(function(){
	$("body").on("click", ".card", function(event){
		var $card = $(event.target);

		// If we click on a card that's not visible, make it visible.
		if (!$card.is('.visible')){
			$card.addClass('visible');
			var $visibleCards = $(".card.visible");
			// If there are two cards that are now visible, make a request to the
			// Game API to check whether they match.
			if ($visibleCards.length >= 2){
				var card1 = $visibleCards[0];
				var card2 = $visibleCards[1];
				playPair(card1, card2);
			}
		}
	});

	// If the New Game Link is clicked on, make a request to the Game API to create
	// a new game.
	$("body").on("click", "#newGameLink", function(event){
		newGame();
	});
});

/**
 * Given the DOM elements of two cards, get their card ID's and make a request to the
 * Game API to play this pair of cards. Then, using the response, refresh the game.
 */
function playPair(card1Dom, card2Dom){
	var $card1 = $(card1Dom);
	var $card2 = $(card2Dom);
	$.ajax({
		url: "game-api.php",
		type: "GET",
		data: {
			action: "play-pair",
			card1: $card1.attr('data-card'),
			card2: $card2.attr('data-card')
		},
		success: function(data){
			// Before refreshing the game, wait a little bit so that the player can see
			// what they card they flipped over.
			setTimeout(function(){refreshGameContainer(data);},350);
		}
	});
}

/**
 * Make a request to the Game API to create a new game. Then, using the response,
 * refresh the game.
 */
function newGame(){
	$.ajax({
		url: "game-api.php",
		type: "GET",
		data: {
			action: "new-game"
		},
		success: refreshGameContainer
	});
}

/**
 * Refresh the game using the HTML provided in gameContainerHtml.
 * In our case, gameContainerHtml is the response returned from the Game API.
 *
 * This method is used by both playPair() and newGame() once there is a successful 
 * response from the Game API.
 */
function refreshGameContainer(gameContainerHtml){
	$("#gameContainer").replaceWith(gameContainerHtml);
}