<?php
namespace BackendBundle\Decorators;

class MicroTimeDecorator {
	
	private $microtime;

	public function __construct($microtime) {
		$this->microtime = $microtime;
	}

	public function beautify() {

		switch ($this->microtime) {
			case $this->microtime * 1000000 < 100:
				return round($this->microtime * 1000000, 1) . ' µs';
			case $this->microtime * 1000 < 100:
				return round($this->microtime * 1000, 1) . ' ms';
			default:
				return round($this->microtime, 1) . ' s';
		}
	}
}