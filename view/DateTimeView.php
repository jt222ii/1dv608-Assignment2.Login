<?php

class DateTimeView {


	public function show() {
		$timeString = date('l\, \t\h\e jS \o\f F Y\, \T\h\e \t\i\m\e \i\s H:i:s'); //http://php.net/manual/en/function.date.php
		return '<p>' . $timeString . '</p>';
	}
}