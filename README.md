mysqli
======

PHP OOP Database class using MySQLi and Singleton pattern.  
Here is a singleton class which extends the mysqli class, allowing you to use all the mysqli methods in a singleton context.


  $mysqli = MySQL::get_connect();
	$Query = "
            	SELECT
	                * 
                FROM 
	                `table_name`
	            ;";
	$result = $mysqli->query($Query); 
