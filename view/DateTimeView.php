<?php

class DateTimeView {


	public function show() {
		//date_default_timezone_set('Europe/Stockholm');
		//blir det servertiden automatiskt?
		// $date = getdate();
		// $timeString = "$date[weekday], the  $date[mday] of $date[month] $date[year] , The time is $date[hours]:$date[minutes]:$date[seconds]";
		//var_dump($date);

		$timeString = date('l\, \t\h\e jS \o\f F Y\, \T\h\e \t\i\m\e \i\s H:i:s'); //http://php.net/manual/en/function.date.php
		return '<p>' . $timeString . '</p>';
	}
}