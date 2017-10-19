<?php
class TopHealthSpot_View_Helper_TitleUrl
{
	public function titleUrl($title)
	{
		$title = str_replace(array('&amp;', '&','!', '@', '$', '#', '*', '^', '\'', '%'),array('','','','','','','',''), trim($title));
		$title = str_replace('  ', '-', $title);
		$title = str_replace(' ', '-', $title);
		return urlencode($title);
	}
}