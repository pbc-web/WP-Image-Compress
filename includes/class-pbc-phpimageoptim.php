<?php

Class PBC_PHPImageOptim extends \PHPImageOptim\PHPImageOptim{
	
	public function clear_chain(){
		$this->chainedCommands = array();
	}

}