<?php
// development cocolabs
// programador: @jpmaster_
class fifa
{
	var $url = "http://es.fifa.com/";

	public function __construct()
	{
		// print $this->getData();
	}

	public function init()
	{
		return $this->getData();
	}

	private function getData()
	{
		$html = $this->getHtml($this->url."worldcup/matches/index.html");

		//toda la rama
		// preg_match('#<div class="match-list-round" id="(?:[0-9]+)" data-roundid="(?:[0-9]+)">(.*?)<div class="navbar sitef-wrap">#si', $html, $r);

		//primera fase
		preg_match('#<div class="match-list-round" id="(?:[0-9]+)" data-roundid="(?:[0-9]+)">(.*?)<div class="match-list-bracket">#si', $html, $r);

		if(empty($r[1])) exit(json_encode(array('error'=>true, 'message'=>'error get data patron base 1')));
		
		preg_match_all('#<div class="mu-i-matchnum">Partido ([0-9]+)</div>#si', $r[1], $num_partido);
		preg_match_all('#<div class="mu-i-group">Grupo ([A-Z])</div>#si', $r[1], $group_partido);
		preg_match_all('#<div class="mu-i-stadium">([^<]+)</div>#si', $r[1], $stadium_partido);
		preg_match_all('#<div class="mu-i-venue">([^<]+)</div>#si', $r[1], $venue_partido);
		preg_match_all('#<span class="t-day">([^<]+)</span>#si', $r[1], $day_partido);
		preg_match_all('#<span class="t-month">([^<]+)</span>#si', $r[1], $month_partido);
		preg_match_all('#<span class="s-scoreText">([^<]+)</span>#si', $r[1], $hour_partido);
		preg_match_all('#<div class="mu-i-datetime">(.*?) <span class="wrap-localtime">Hora Local</span></div>#si', $r[1], $date_partido);
		
		preg_match_all('#<div class="mu-m"><div class="t home">(.*?)<div class="mu-reasonwin">#si', $r[1], $rr);
		// preg_match_all('#<span class="t-nText ">([^<]+)</span><span class="t-nTri">([^<]+)</span>#si', $rr[1], $countrys);
		


		$tabla = array();
		for ($i=0; $i < count($num_partido[1]); $i++) 
		{ 
			preg_match_all('#<img src="(?P<country_flag>[^"]+)" alt="(?P<country_name>[^"]+)" class="(?P<country_code>.*?) i-4-flag flag" /#si', $rr[1][$i], $c);
			unset($c[0], $c[1], $c[2], $c[3]);

			$tabla[] = array(
				'group'				=>$group_partido[1][$i],
				'number'	=>$num_partido[1][$i],
				'stadium'			=>$stadium_partido[1][$i],
				'venue'	=>$venue_partido[1][$i],
				'day'				=>$day_partido[1][$i],
				'month'				=>$month_partido[1][$i],
				'hour'				=>$hour_partido[1][$i],
				'versus'			=>$c,
				'date'				=>$date_partido[1][$i],
				);
			// print $num_partido[1][$i];
			// print '<br>';
			// print $group_partido[1][$i];
			// print '<hr>';
		}

		return json_encode(array('fase'=>1, 'tabla'=>$tabla));
	}

	private function getHtml($lnk)
	{
		return file_get_contents($lnk);
	}
}
