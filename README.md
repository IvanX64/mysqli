PHP MySQLi Class (Multiple connections / PHP MySQL Profiler)
----------
PHP5 OOP DB Connection Class with MySQLi using Singleton, which support multiple connections.
MySQLi connection avaliable to all MVC modules.

#### Use ####
Setting up config vars into **config_db.php**

    // DB #1
	const DB_HOST_local = 'localhost';
    const DB_USER_local = 'user';  
    const DB_PASS_local = 'pass'; 
    const DB_NAME_local = 'db1'; 

    // DB #2
	const DB_HOST_log = 'localhost';
    const DB_USER_log = 'user';  
    const DB_PASS_log = 'pass'; 
    const DB_NAME_log = 'db2';
  
Insert this into your php script

    require_once(__DIR__ . '/mysqli/class.mysql.php');

Query for DB #1 (Default - local)
	
	$mysqli = MySQL::get_connect();
	$Query = "
            	SELECT
	                * 
                FROM 
	                `table_name`
	            ;";
	$result = $mysqli->query($Query); 

If you need multiple connections  
Query for DB #2
	
	$mysqli_db2 = MySQL::get_connect('log');
	$Query_db2 = "
            	SELECT
	                * 
                FROM 
	                `table_name`
	            ;";
	$result_db2 = $mysqli_db2->query($Query_db2);


#### PHP MySQL Profiler ####
PHP MySQL profiler allows you to trace SQL queries made in PHP code, the number of times they are called and the break down of their open, execution, prepare and fetch results times. 

How to Profile SQL queries in PHP Code
Set
Analyze the code profiling results in the profiler window.  


How to Use the results of PHP SQL Profiler
PHP SQL profiler provides the following options to use for the inspection of the results and php code navigation 
1.Location. Shows the code lines where SQL query is executed. 
2.Open. Shows the time spent to open connection to the database 
3.Free. Shows the time spent to free all the associated resources 
4.Prepare. Shows the time spent to prepare SQL query (if prepare is used) 
5.#Exec. Shows the number of times corresponding SQL query is executed during the run of the profiler 
6.Exec. Shows the time of SQL execution 
7.#Fetch. Shows the number of times SQL results were fetched during the profiler run 
8.Fetch. Shows time spent to fetch this SQL results 
9.Chart. Shows the relative value of every SQL. The highest value is assigned with 100%, while the others are shown as against to this one. In the popup menu you can select any output column to be displayed in the chart. 