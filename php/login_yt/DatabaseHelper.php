<?php

class DatabaseHelper
{
    const username = 'a11913405';
    const password = 'dbs20';
    const con_string = 'lab';

    protected $conn;

    // Create connection in the constructor
    public function __construct()
    {
        try {
            $this->conn = oci_connect(
                DatabaseHelper::username,
                DatabaseHelper::password,
                DatabaseHelper::con_string
            );
            if (!$this->conn) {
                die("DB error: Connection can't be established!");
            }
        } catch (Exception $e) {
            die("DB error: {$e->getMessage()}");
        }
    }

    public function __destruct()
    {
        @oci_close($this->conn);
	}
	
	public function check_login()
	{
        var_dump($_SESSION);
		if(isset($_SESSION['userID']))
	    {
        $id = $_SESSION['userID'];
		$sql = "select * from users";
		$statement = @oci_parse($conn, $sql);
		$result = @oci_execute($statement);
        @oci_free_statement($statement);
		if($result && @oci_num_rows($result) > 0)
		{
			$user_data = oci_fetch_assoc($result);
			return $user_data;
		}
	    }
		//redirect to login
		header("Location: login.php");
		die;

    }
    
    public function insertIntoUsers($nickname, $password, $email)
    {
        $sql = "INSERT INTO users (nickname, password, email) VALUES ('$nickname', '$password', '$email')";
        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function exist_user($nickname, $password)
    {
        $sql = "SELECT * FROM users WHERE nickname = '$nickname' AND password = '$password'";
        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement);
        oci_free_statement($statement);	
        return $success;
    }

    public function get_user($nickname, $password)
    {
        $sql = "SELECT * FROM users WHERE nickname = '$nickname' AND password = '$password'";
        $statement = oci_parse($this->conn, $sql);
        $success = oci_execute($statement);
        oci_free_statement($statement);	
        $user_data = oci_fetch_assoc($statement);
        var_dump( $user_data["userID"]);
        return $user_data;
    }
}
