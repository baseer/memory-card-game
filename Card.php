<?php
class Card {
	private $imageUrl;
	// Solved state of the card. Used when the player found the other card that matches
	// this card.
	const STATE_SOLVED = 0;
	// Unsolved state of the card. Used when the player has yet to find the other card
	// that matches this card.
	const STATE_UNSOLVED = 1;
	private $state = self::STATE_UNSOLVED;

	public function setImageUrl($imageUrl){
		$this->imageUrl = $imageUrl;
	}
	public function getImageUrl(){
		return $this->imageUrl;
	}
	/**
	 * Mark this card as solved.
	 */
	public function solve(){
		$this->state = self::STATE_SOLVED;
	}
	/**
	 * Mark this card as unsolved.
	 */
	public function unsolve(){
		$this->state = self::STATE_UNSOLVED;
	}
	/**
	 * Return true if the card is marked as solved. Return false otherwise.
	 */
	public function isSolved(){
		return $this->state == self::STATE_SOLVED;
	}
	/**
	 * Return true if $card1 matches $card2, based on the image url. Return false
	 * otherwise.
	 */
	public static function compare($card1, $card2){
		$card1Image = $card1->getImageUrl();
		$card2Image = $card2->getImageUrl();
		return $card1Image == $card2Image;
	}
	/**
	 * Create a new card. If an argument is passed in, use it as an image URL for the
	 * card.
	 */
	public function __construct(){
		$numargs = func_num_args();
		if ($numargs > 0){
			$imageUrl = func_get_arg(0);
			$this->setImageUrl($imageUrl);
		}
	}
}