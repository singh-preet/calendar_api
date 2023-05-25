<?php
class Database
{
	var $sql_string = '';
	var $error_no = 0;
	var $error_msg = '';
	private $conn;
	public $last_query;
	private $magic_quotes_active;
	private $real_escape_string_exists;

	//localdb
/*	private $db_host = "localhost";
	private $db_database = "events";
	private $db_user = "sunpreet";
	private $db_pass = "SP@9933";*/

	//for online  db
	private $db_host = "localhost";
	private $db_database = "sunpreet_events";
	private $db_user = "sunpreet";
	private $db_pass = "SP@9933_events";



	function __construct()
	{
		$this->open_connection();
		$this->magic_quotes_active = get_magic_quotes_gpc();
		$this->real_escape_string_exists = function_exists("mysqli_real_escape_string");
	}

	public function open_connection()
	{
		$this->conn = mysqli_connect($this->db_host, $this->db_user, $this->db_pass);
		if (!$this->conn) {
			echo "Problem in database connection! Contact administrator!";
			echo "DB Connection error ";
			exit();

		} else {

			$db_select = mysqli_select_db($this->conn, $this->db_database);
			if (!$db_select) {
				echo "Problem in selecting database! Contact administrator!";
				exit();
			}
		}

	}

	function setQuery($sql = '')
	{
		$this->sql_string = $sql;
	}

	function executeQuery()
	{
		$result = mysqli_query($this->conn, $this->sql_string);
		return $result;
	}



	function loadResultList($key = '')
	{
		$cur = $this->executeQuery();

		$array = array();
		while ($row = mysqli_fetch_object($cur)) {		
				$array[] = $row;
		}
		mysqli_free_result($cur);
		return $array;
	}


	public function close_connection()	{
	    mysqli_close($this->conn);
		
	}
}
?>