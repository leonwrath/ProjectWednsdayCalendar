<?php
	include('simple_html_dom.php');
	
	echo "<html><head><meta charset='UTF-8'></head><body>***START***<br/>\n";
	$url = "https://www.prosa.dk/kalender/hele-kalenderen/?tx_moccrmintegration_courses[action]=list";
	
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$cl = curl_exec($ch);
	
	$html = new simple_html_dom();
	$html->load($cl);
	$kurser = $html->find('div.arrangement');
	
	echo "Antal arrangementer:".sizeof($kurser)."<br/>\n";
	for ($i=0;$i<sizeof($kurser);++$i) {
		echo "********************<br/>\n";
		echo "Titel:".$kurser[$i]->find('a',0)->innertext."<br/>\n";
		echo "Tidspunkt og sted:".$kurser[$i]->find('p.date',0)->innertext."<br/>\n";
		echo "Beskrivelse:".$kurser[$i]->find('p',-1)->innertext."<br/>\n";
		echo "Link:". "https://www.prosa.dk" .$kurser[$i]->find('a',0)->href."<br/>\n";
	}
	echo "***SLUT***\n</body></html>";
?>