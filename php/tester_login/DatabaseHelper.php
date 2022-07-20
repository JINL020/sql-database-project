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

    // This function creates and executes a SQL select statement and returns an array as the result
    // 2-dimensional array: the result array contains nested arrays (each contains the data of a single row)
    public function selectAllUsers($userID, $nickname, $email)
    {
        // Define the sql statement string
        // Notice that the parameters $person_id, $surname, $name in the 'WHERE' clause
        $sql = "SELECT * FROM users
            WHERE userID LIKE '%$userID%'
              AND upper(nickname) LIKE upper('%$nickname%')
              AND upper(email) LIKE upper('%$email%')
            ORDER BY userID ASC";

        // oci_parse(...) prepares the Oracle statement for execution
        // notice the reference to the class variable $this->conn (set in the constructor)
        $statement = @oci_parse($this->conn, $sql);

        // Executes the statement
        @oci_execute($statement);

        // Fetches multiple rows from a query into a two-dimensional array
        // Parameters of oci_fetch_all:
        //   $statement: must be executed before
        //   $res: will hold the result after the execution of oci_fetch_all
        //   $skip: it's null because we don't need to skip rows
        //   $maxrows: it's null because we want to fetch all rows
        //   $flag: defines how the result is structured: 'by rows' or 'by columns'
        //      OCI_FETCHSTATEMENT_BY_ROW (The outer array will contain one sub-array per query row)
        //      OCI_FETCHSTATEMENT_BY_COLUMN (The outer array will contain one sub-array per query column. This is the default.)
        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);

        return $res;
    }

    // creates and executes SQL insert statement
    // returns true or false
    public function insertIntoUsers($nickname, $password, $email)
    {
        $sql = "INSERT INTO users (nickname, password, email) VALUES ('$nickname', '$password', '$email')";
        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    // Using a SQL Procedure
    // deletes a person and returns an errorcode (&errorcode == 1 : OK)
    public function deleteUser($userID)
    {
        // It is not necessary to assign the output variable,
        // but to be sure that the $errorcode differs after the execution of our procedure we do it anyway
        $errorcode = 0;

        // In our case the procedure P_DELETE_PERSON takes two parameters:
        //  1. userID (IN parameter)
        //  2. error_code (OUT parameter)

        $sql = 'BEGIN P_DELETE_USER(:userID, :errorcode); END;';
        $statement = @oci_parse($this->conn, $sql);

        //  Bind the parameters
        @oci_bind_by_name($statement, ':userID', $userID);
        @oci_bind_by_name($statement, ':errorcode', $errorcode);

        @oci_execute($statement);

        //Note: Since we execute COMMIT in our procedure, we don't need to commit it here.
        //@oci_commit($statement); //not necessary

        @oci_free_statement($statement);

        //$errorcode == 1 => success
        //$errorcode != 1 => Oracle SQL related errorcode;
        return $errorcode;
    }
}