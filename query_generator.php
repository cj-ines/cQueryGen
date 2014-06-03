<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!----<link rel="stylesheet" href="css/bootstrap.css"  type="text/css"/>-->
<title>Bulk Query Generator</title>
<script type="text/javascript">
function generate_sql() {
	var db=document.getElementById('DB').value
	var ids=document.getElementById('IDs').value
	var dispo=document.getElementById('DISPO').value
	var res=new XMLHttpRequest()
	res.onreadystatechange=function() {
	    document.getElementById('SQL_GEN').innerHTML='wait...';
		if (res.readyState==4 && res.status==200) {
    	  document.getElementById('SQL_GEN').innerHTML=res.responseText;
		}
  	}
	res.open("GET","req/gen_sql.php?IDs="+ids+"&DISPO="+dispo+"&DB="+db,true);
	res.send();
	
}
</script>

</head>
<body>


  IDs:<input name="IDs" id="IDs"  value="0"/>
  Dispo:
  <select name="DISPO" id="DISPO">
    <option value="-99">(-99) Completed Not Qualified</option>
    <option value="-61">(-61) Completed No Quota</option>
	<option value="-22">(-22) Delete</option>
  </select>
  Campaign:
  <select name="DB" id="DB">
       <option value="1">CCC (zoopmobility-schneider-ccc)</option>
       <option value="2">Power (cati_schneider_power_live)</option>
       <option value="3">Service (cati_schneider_service_live)</option>
       <option value="4">Buildings (zoopmobility-schneider-cati)</option>
       <option value="5">Other(cati_schneider_power_other)</option>
  </select>
  <button type='button' onclick="generate_sql()">Gen SQL</button>
  <br />
  <textarea cols="100" name="SQL_GEN" style="height:400px;  background-color:#F5F5F5" id="SQL_GEN"></textarea>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>