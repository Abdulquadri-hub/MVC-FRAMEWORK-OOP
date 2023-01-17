<?php 

/**
 *  SESSION CLASS
 */

defined('ROOTPATH') OR exit('Access Denied!');

class Session {

    public static $mainkey = 'APP';
	public static $userkey = 'USER';

	/** activate session if not yet started **/
	private static function start_session():int
	{
		if (session_status() === PHP_SESSION_NONE) {
		session_start();
		}

		return 1;
	}

	/** put data into the session **/
	public static function set(mixed $keyOrArray, mixed $value = ''):int
	{
		Session::start_session();

		if(is_array($keyOrArray))  
		{
			foreach ($keyOrArray as $key => $value) {
				
				$_SESSION[Session::$mainkey][$key] = $value;
			}

			return 1;
		}

		$_SESSION[Session::$mainkey][$keyOrArray] = $value;

		return 1;
	}

	/** get data from the session. default is return if data not found **/
	public static function get(string $key, mixed $default = ''):mixed
	{
		
		Session::start_session();

		if(isset($_SESSION[Session::$mainkey][$key]))
		{
			return $_SESSION[Session::$mainkey][$key];
		}

		return $default;
	}

	/** saves the user row data into the session after a login **/
	public static function auth(mixed $user_row):int
	{
		Session::start_session();

		$_SESSION[Session::$userkey] = $user_row;

		return 0;
	}

	/** removes user data from the session **/
	public static function flush():int
	{
		Session::start_session();

		if(!empty($_SESSION[Session::$mainkey])){
			
			unset($_SESSION[Session::$mainkey]);
		}

		return 0;
	}

	/** removes user data from the session **/
	public static function logout():int
	{
		Session::start_session();

		if(!empty($_SESSION[Session::$userkey])){
			
			unset($_SESSION[Session::$userkey]);
		}

		return 0;
	}

	/** checks if user is logged in **/
	public static function is_logged_in():bool
	{
		Session::start_session();

		if(!empty($_SESSION[Session::$userkey])){
			
			return true;
		}

		return false;
	}

	/** gets data from a column in the session user data **/
	public static function user(string $key = '', mixed $default = ''):mixed
	{
		Session::start_session();

		if(empty($key) && !empty($_SESSION[Session::$userkey])){

			return $_SESSION[Session::$userkey];
		}else

		if(!empty($_SESSION[Session::$userkey]->$key)){
			
			return $_SESSION[Session::$userkey]->$key;
		}

		return $default;
	}

	/** returns data from a key and deletes it **/
	public static function pop(string $key, mixed $default = ''):mixed
	{
		Session::start_session();
		
		if(!empty($_SESSION[Session::$mainkey][$key])){
			
			$value = $_SESSION[Session::$mainkey][$key];
			unset($_SESSION[Session::$mainkey][$key]);
			return $value;
		}

		return $default;
	}

	/** returns all data from the APP array **/
	public static function all():mixed
	{
		Session::start_session();

		if(isset($_SESSION[Session::$mainkey]))
		{
			return $_SESSION[Session::$mainkey];
		}

		return [];
	}

	/** GET USER COLUMN AUTOMATICALLY **/
	public static function __callStatic($function, $params)
    {
		Session::start_session();

        $key = strtolower(str_replace("get", "", $function));
        if (isset($_SESSION[Session::$userkey]->$key)) 
		{
            return $_SESSION[Session::$userkey]->$key;
        }
        return 'unknown';
        
    } 

}
