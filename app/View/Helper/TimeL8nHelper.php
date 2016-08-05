<?php
class TimeL8nHelper extends AppHelper {

	var $helpers = array('Time');

	function niceShort($dateString = null, $userOffset = null){
		$date = $dateString ? $this->Time->fromString($dateString, $userOffset) : time();

		$y = $this->Time->isThisYear($date) ? '' : ' %Y';

		if ($this->Time->isToday($date)){
			$ret = sprintf(__('Today, %s'), strftime("%H:%M", $date));
		}
		elseif ($this->Time->wasYesterday($date)){
			$ret = sprintf(__('Yesterday, %s'), strftime("%H:%M", $date));
		}
		else {
			$fstr = sprintf(__("%%b %%eS%s, %%H:%%M"), $y);
			$format = $this->Time->convertSpecifiers($fstr, $date);
			$ret = strftime($format, $date);
		}
		return ($ret);
	}
}
?>
