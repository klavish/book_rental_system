<?php

class Database
{

    // Database connection parameters
    private $db_host = 'localhost';
    private $db_user = 'root';
    private $db_pass = 'Lavish@1233';
    private $db_name = 'book_shop_db';

    // Database connection variables
    private $mysqli = "";
    private $result = array();
    private $conn = false;

    /**
     * Constructor function to establish a database connection.
     * If connection fails, an error is added to the result array.
     */
    public function __construct()
    {
        if (!$this->conn) {
            $this->mysqli = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);
            $this->conn = true;
            if ($this->mysqli->connect_error) {
                array_push($this->result, $this->mysqli->connect_error);
                return false;
            }
        } else {
            return true;
        }
    }

    /**
     * Insert data into the specified table using the provided parameters.
     * If the table exists, the function constructs and executes an SQL INSERT query.
     *
     * @param string $table The name of the table to insert data.
     * @param array $params Associative array in which keys represent column, values represent data.
     * @return bool|int If data inserted, returns true. If error, returns false. If table doesn't exist, returns false.
     */
    public function insert($table, $params = array())
    {
        // Check if the table exists
        if ($this->tableExists($table)) {

            // Construct SQL INSERT query
            $table_columns = implode(', ', array_keys($params));
            $table_value = implode("', '", $params);
            $sql = "insert into $table($table_columns) values ('$table_value')";

            // Execute the query
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->insert_id);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }

        } else {
            return false;
        }
    }

     /**
 * Insert image-related data into the specified table using the provided parameters.
 * If the table exists, the function constructs and executes an SQL INSERT query.
 *
 * @param string $table The name of the table to insert data.
 * @param array $params Associative array where keys represent column names, and values represent image-related data.
 * @return bool True if data inserted successfully, false otherwise. If the table doesn't exist, returns false.
 */
public function insertImage($table, $params = array())
{
    // Check if the table exists
    if ($this->tableExists($table)) {

        // Construct SQL INSERT query
        $table_columns = implode(', ', array_keys($params));
        $table_value = implode("', '", array_values($params));
        $sql = "insert into $table($table_columns) values ('$table_value')";

        // Execute the query
        if ($this->mysqli->query($sql)) {
            array_push($this->result); 
            return true;
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }

    } else {
        return false;
    }
}


    /**
     * Update records in the specified table based on the provided parameters and condition.
     * If the table exists, the function constructs and executes an SQL UPDATE query.
     *
     * @param string $table The name of the table to update.
     * @param array $params Associative array in which keys represent column, values represent new data.
     * @param string|null $where The condition to apply in the WHERE clause.
     */
    public function update($table, $params = array(), $where = null)
    {
        if ($this->tableExists($table)) {

            $args = array();
            foreach ($params as $key => $value) {
                $args[] = "$key = '$value'";
            }
            $sql = "update $table set " . implode(', ', $args);
            if ($where != null) {
                $sql .= " where $where";
            }
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
            } else {
                array_push($this->result, $this->mysqli->error);
            }
        } else {
            return false;
        }
    }

    /**
     * Delete records from the specified table based on the provided condition.
     * If the table exists, the function constructs and executes an SQL DELETE query.
     *
     * @param string $table The name of the table to delete records from.
     * @param string|null $where The condition to apply in the WHERE clause.
     * @return bool True if records deleted, false otherwise.
     */
    public function delete($table, $where = null)
    {
        if ($this->tableExists($table)) {
            $sql = "delete from $table";
            if ($where != null) {
                $sql .= " Where $where";
            }
            if ($this->mysqli->query($sql)) {
                array_push($this->result, $this->mysqli->affected_rows);
                return true;
            } else {
                array_push($this->result, $this->mysqli->error);
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Execute an SQL query and return the result as an associative array.
     *
     * @param string $sql The SQL query to execute.
     * @return bool True if query successful, false otherwise.
     */
    public function sql($sql)
    {
        $query = $this->mysqli->query($sql);
        if ($query) {
            $this->result = $query->fetch_all(MYSQLI_ASSOC);
            return true;
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }

    /**
     * Execute an SQL query to retrieve a single column value.
     *
     * @param string $sql The SQL query to execute.
     * @return mixed The result of the query.
     */
    public function selectId($sql)
    {
        $query = $this->mysqli->query($sql);
        if ($query) {
            $this->result = $query->fetch_column();
            return $this->result;
        } else {
            array_push($this->result, $this->mysqli->error);
            return false;
        }
    }

    /**
     * Destructor function to close the database connection.
     *
     * @return bool True if connection closed, false otherwise.
     */
    public function __destruct()
    {
        if ($this->conn) {
            if ($this->mysqli->close()) {
                $this->conn = false;
                return true;
            }
        } else {
            array_push($this->result, $table . " does not exist in the database");
            return false;
        }
    }

    /**
     * Get the result of the last query executed.
     *
     * @return array The result of the last query.
     */
    public function getResult()
    {
        $val = $this->result;
        $this->result = array();
        return $val;
    }

    /**
     * Get the last auto-incremented ID generated by the INSERT query.
     *
     * @return int The last auto-incremented ID.
     */
    public function getId()
    {
        $val = $this->mysqli->insert_id;
        return $val;
    }

    /**
     * Check if a table exists in the database.
     *
     * @param string $table The name of the table to check.
     * @return bool True if the table exists, false otherwise.
     */
    private function tableExists($table)
    {
        $sql = "show tables from $this->db_name like '$table'";
        $tableInDb = $this->mysqli->query($sql);
        if ($tableInDb) {
            if ($tableInDb->num_rows == 1) {
                return true;
            } else {
                return false;
            }
        }
    }
}
?>
