<?php

$month = $_GET['m'];
$year = $_GET['y'];


echo reporter($month, $year);


function reporter ($month, $year) {

	$months = "COUNT(IF((YEAR(state_date)=2012 AND MONTH(state_date)=12),1,NULL)) AS `2012 12`,";

	for ($i = 2013;  $i < $year; $i++)
	{
		for ($j = 1; $j <=12; $j++) {
			$months .= "COUNT(IF((YEAR(state_date)=$i AND MONTH(state_date)=$j),1,NULL)) AS `$i $j`,";
		}
	}

	for ($j = 1; $j <=$month; $j++) {
	     $months .= "COUNT(IF((YEAR(state_date)=$i AND MONTH(state_date)=$j),1,NULL)) AS `$i $j`,";
		}

	$query=
		"SELECT 
			SUBSTR(c.ID_Centre,4,5) AS `N Centre`,
			c.LibelleCentre,
			r.Libelle AS Secteur,
			z.Libelle AS Zone,
			$months
			1
			
		FROM 
		`zoopmobility-norauto-sat-live`.Centres c 
		LEFT JOIN `zoopmobility-cati-midas-fra`.cati_feed cf ON c.ID_Centre = cf.shop_id 
		LEFT JOIN `zoopmobility-cati-midas-fra`.cati_feed_state cs ON cf.feed_id = cs.feed_id
		LEFT JOIN `zoopmobility-norauto-sat-live`.Regions r ON r.ID_Region = c.IDRegion
		LEFT JOIN `zoopmobility-norauto-sat-live`.Regions z ON r.ParentID = z.ID_Region

		WHERE cs.state_value = 'Completed'
		AND cf.shop_type = 'A' AND c.Statut = 1
		GROUP BY c.ID_Centre";	
		return $query;
}


