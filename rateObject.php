<?php

class rate{
	private $desination;
	private $rate;
	private $accessNumber;


	public function getDestination() {
		return $this->desination;
	}
	public function setDestination($desination) {
		$this->desination = $desination;
	}

	public function getRate() {
		return $this->rate;
	}
	public function setRate($rate) {
		$this->rate = $rate;
	}

	public function getAccessNumber() {
		return $this->accessNumber;
	}
	public function setAccessNumber($accessNumber) {
		$this->accessNumber = $accessNumber;
	}

}

?>