<?php
require_once("Card.php");
class Game {
	const WIDTH = 6; // Number of cards across.
	const HEIGHT = 4; // Number of cards down.
	private $cards; // Holds the cards of the game.

	public function getCards(){
		return $this->cards;
	}
	public function setCards($cards){
		$this->cards = $cards;
	}

	/**
	 * Given the ID's of two cards being played, check if they match. If they do,
	 * mark both cards as solved.
	 * If all cards are solved, create a new game by calling the constructor.
	 */
	public function updateStateFromAction($card1Num, $card2Num){
		$cards = $this->getCards();
		$match = Card::compare($cards[$card1Num], $cards[$card2Num]);
		if ($match){
			$cards[$card1Num]->solve();
			$cards[$card2Num]->solve();
		}
		if ($this->isGameComplete()){
			$this->__construct();
		}
	}

	/**
	 * Return true if the game is complete. That is, all cards are solved.
	 */
	private function isGameComplete(){
		$cards = $this->getCards();
		foreach ($cards as $card){
			if (!$card->isSolved()){
				return false;
			}
		}
		return true;
	}

	/**
	 * Return an array of shuffled Cards that can be used by $this->setCards().
	 */
	public static function generateCards(){
		$cards = array();
		$numCards = self::WIDTH * self::HEIGHT;
		$numPairs = $numCards / 2;
		for ($i=0; $i < $numPairs; $i++){
			$cardImageUrl = self::generateRandomCardImage();
			$card1 = new Card($cardImageUrl);
			$card2 = new Card($cardImageUrl);
			$cards[] = $card1;
			$cards[] = $card2;
		}
		shuffle($cards);
		return $cards;
	}

	/**
	 * Return the image url of a random card.
	 *
	 * Currently, in the img/ directory, a card has the form "9_of_hearts.png".
	 * Image urls are generated based on this form.
	 */
	public static function generateRandomCardImage(){
		$imageUrl = "img/";
		$numbers = array('ace', 2,3,4,5,6,7,8,9,10, 'jack', 'queen', 'king');
		$suits = array('clubs', 'diamonds', 'hearts', 'spades');

		$randomNumberKey = array_rand($numbers);
		$randomNumber = $numbers[$randomNumberKey];

		$randomSuitKey = array_rand($suits);
		$randomSuit = $suits[$randomSuitKey];
		return "img/{$randomNumber}_of_{$randomSuit}.png";
	}

	/**
	 * Create a new game by generating an initial set of random cards.
	 */
	public function __construct(){
		$cards = self::generateCards();
		$this->setCards($cards);
	}
}