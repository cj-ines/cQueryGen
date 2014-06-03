<?php
  $query="";
  $IDs=$_GET['IDs'];
  $DB=$_GET['DB'];
  $DISPO=$_GET['DISPO'];
  $TABLE="Schneider_2014Q1";
  
  switch($DB) {
   case 1: $DB="zoopmobility-schneider-ccc"; $TABLE="SURVEYS_CATI";break;
   case 2: $DB="cati_schneider_power_live";break;
   case 3: $DB="cati_schneider_service_live"; $TABLE="SERVICE_SURVEY";break;
   case 4: $DB="zoopmobility-schneider-cati";break;
   case 5: $DB="cati_schneider_other_live";break;

  }
  
  echo $query="
-- Bulk change query generator - Crisdel James Ines
-- ".$today = date("Y-m-d")." 
SET sql_safe_updates=1;
USE `".$DB."`;
-- Verify the names to make sure you are editing the right ones 
 
  SELECT * FROM cati_feed cf
  LEFT JOIN ".$TABLE." s
    ON cf.feed_id = s.cati_feed_id
  WHERE s.surveyID IN(".$IDs.");
-- copy to deleted table

  INSERT ".$TABLE."_DELETED  
  SELECT s.* FROM cati_feed cf
  LEFT JOIN ".$TABLE." s
    ON cf.feed_id = s.cati_feed_id
  WHERE s.surveyID IN(".$IDs.");
-- get feed_id's
 
 SELECT
   GROUP_CONCAT(s.cati_feed_id)  
 FROM ".$TABLE." s
  WHERE s.surveyID IN(".$IDs.") ;

-- set to ".$DISPO."

  UPDATE cati_feed cf
  SET completed='".$DISPO."'
  WHERE cf.feed_id IN ( PASTE_FEED_IDS_HERE );

--   delete surveys
 DELETE FROM ".$TABLE."
  WHERE surveyID IN(".$IDs.");
#===========   DONE!  =========
";

?>
