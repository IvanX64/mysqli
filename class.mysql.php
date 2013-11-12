<?php
    /** 
    * PHP5 OOP DB Connection Class with MySQLi using Singleton, which support multiple connections.
    * MySQLi connection avaliable to all MVC modules.
    * 
    * 
    * @example	$mysqli = MySQL::get_connect();
    * 
    * @author	Maxim Baikuzin <maxim@baikuzin.com> 
    * 			http://www.baikuzin.com
    * @version	12.11.2013
    * @license 	GNU GPLv3
    */

    require_once(__DIR__ . '/config_db.php');
    
    class MySQL extends mysqli implements config_db {
        private static $_instance = array();

        private function __construct($db){
            self::connect_open($db);
        }                                  
        private function connect_open($db) {
            @parent::__construct(constant("self::DB_HOST_$db"), constant("self::DB_USER_$db"), constant("self::DB_PASS_$db"), constant("self::DB_NAME_$db"));
            if ($this->connect_error) self::error_503($this->connect_error);
        }                                   
        /**
        * Get connection
        * 
        * @param mixed local, replica, log
        * @param mixed On/Off Profile MySQL
        */
        public static function get_connect($db = 'local', $profiler = false) {
        	// Connect / Reconnect
            if (null === self::$_instance[$db] OR self::$_instance[$db]->ping() === false) {
            	if ($profiler === false) {
            		self::$_instance[$db] = new self($db);
				} 
				else {
					self::$_instance[$db] = new MySQL_Profiler($db);
				}
                return self::$_instance[$db];
            }                         
            return self::$_instance[$db];                       
        }
        private function __clone() { } 
        private function __wakeup(){ }        
        private function error_503($error) {
            header('HTTP/1.1 503 Service Temporarily Unavailable');
            header('Status: 503 Service Temporarily Unavailable');
            header('Retry-After: 300'); 
            echo '        
            <!DOCTYPE HTML PUBLIC "-//IETF//DTD HTML 2.0//EN">
            <html><head>
            <title>503 Service Temporarily Unavailable</title>
            </head><body>
            <h1>Service Temporarily Unavailable</h1>
            <p>The server is temporarily unable to service your
            request due to maintenance downtime or capacity
            problems. Please try again later.</p>
            </body></html>
            ';        
            //
            $date = date('Y-m-d H:i:s');
            $file_mysql_error = dirname(__DIR__) . '/error_log';
            // 
            $fp = fopen($file_mysql_error, 'a');
            fwrite($fp, "[{$date}] {$error} \r\n");
            fclose($fp);
            exit;
        }       
    }


?>