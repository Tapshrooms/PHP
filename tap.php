<?php
	class Pressure
	{
		protected
			$_parent = null,
			$_pressure = 0,
			$_multiplier = 1.25,
			$_max = 20;

		public function __construct($tap, $default = 0, $multiplier = 1.25, $max = 20)
		{
			$this->_parent = $tap;
			$this->_pressure = $default;
			$this->_multiplier = $multiplier;
			$this->_max = $max;
		}

		public function decrease($multiplier = null)
		{
			if (is_null($multiplier)) {
				$multiplier = $this->_multiplier;
			}
			$this->_pressure /= $multiplier;
			if ($this->_pressure <= 0) {
				$this->_parent->stop();
			}
		}

		public function increase($multiplier = null)
		{
			if (is_null($multiplier)) {
				$multiplier = $this->_multiplier;
			}
			$this->_pressure *= $multiplier;
			if ($this->_pressure >= $this->_max) {
				$this->_parent->explode_();
			}
		}

		public function get()
		{
			return $this->_pressure;
		}

		public function set($new)
		{
			$this->_pressure = $new;
		}
	}

	class Tap
	{
		public $pressure = null;

		public function __construct($run = true)
		{
			$this->pressure = new Pressure($this);
			$this->say("I'm a tap!");
			if ($run) {
				$this->run();
			}
		}

		public function run()
		{
			if ($this->pressure->get() != 0) {
				$this->say("I'm already running!");
				return;
			}
			$this->pressure->set(4);
			$this->say("Catch me if you can!");
		}

		public function stop()
		{
			if ($this->pressure->get() == 0) {
				$this->say("I'm not running!");
				return;
			}
			$this->pressure->set(0);
			$this->say("I've stopped!");
		}

		public function explode_()
		{
			$this->pressure->set(0);
			$this->say("BANG!");
		}

		public function say($what, $end = "\n")
		{
			print $what . $end;
		}
	}
?>