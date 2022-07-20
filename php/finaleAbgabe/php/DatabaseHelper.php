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

    // creates and executes SQL select statement and returns an array as the result
    // 2-dimensional array: the result array contains nested arrays (each contains the data of a single row)
    public function selectAllUsers($userID, $nickname)
    {
        $sql = "SELECT * FROM users
            WHERE userID LIKE '%$userID%'
              AND upper(nickname) LIKE upper('%$nickname%')
            ORDER BY userID ASC";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
        @oci_fetch_all($statement, $res, null, null, OCI_FETCHSTATEMENT_BY_ROW);
        @oci_free_statement($statement);
        return $res;
    }

    public function selectAllRecipe($title, $preptime, $writer)
    {
        $sql = "SELECT * FROM recipe
            WHERE upper(title) LIKE upper('%$title%')
              AND preptime LIKE '%$preptime%'
              AND writer LIKE '%$writer%'
            ORDER BY recipeID ASC";
        $statement = @oci_parse($this->conn, $sql);
        @oci_execute($statement);
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

    public function insertIntoFriend($userID_1, $userID_2)
    {
        $sql = "INSERT INTO friend (user1, user2) VALUES ($userID_1, $userID_2)";
        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function insertIntoContains($compilation, $recipe)
    {
        $sql = "INSERT INTO contains (compilation, recipe) VALUES ($compilation, $recipe)";
        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function insertIntoRecipe($title, $preptime, $description, $writer)
    {
        $sql = "INSERT INTO recipe (title, preptime, description, writer) VALUES ('$title', $preptime, '$description', $writer)";
        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    public function insertIntoCompilation($title, $description, $userID)
    {
        $sql = "INSERT INTO compilation (title, description, userID) VALUES ('$title', '$description', $userID)";
        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }

    // Using a SQL Procedure to deletes a person
    //returns an errorcode (&errorcode == 1 : OK)
    public function deleteUser($userID)
    {
        $errorcode = 0;
   
        // In our case the procedure P_DELETE_USER takes two parameters:
        //  1. UserID (IN parameter)
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

    public function updatePassword($userID, $new_password)
    {
        $sql = "UPDATE users SET password = '$new_password' WHERE $userID = users.userID";
        $statement = @oci_parse($this->conn, $sql);
        $success = @oci_execute($statement) && @oci_commit($this->conn);
        @oci_free_statement($statement);
        return $success;
    }
}