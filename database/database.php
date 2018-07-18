<?php
abstract class DataBase
{
    protected $db;
    public function __construct($host = "localhost", $username = "root", $password = "", $databasename = "project")
    {
        $this->db = new mysqli($host, $username, $password, $databasename);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    protected function queryTreatment($query)
    {
        // echo "<pre>";
        // var_dump($query);
        // echo "</pre>";
        $queryResult = $this->db->query($query);
        $typeOfResult = gettype($queryResult);
        if ($typeOfResult == "boolean") {
            return $queryResult;
        } else {
            $returnArray = [];
            while ($row = $queryResult->fetch_assoc()) {
                array_push($returnArray, $row);
            }
            return $returnArray;
        }
    }

    public function getLastId()
    {
        return $this->db->insert_id;
    }

    public function describeTable($table_name)
    {
        $field_names = [];
        $describeArray = $this->queryTreatment("DESCRIBE $table_name");
        foreach ($describeArray as $value) {
            array_push($field_names, $value['Field']);
        }
        return $field_names;
    }

    public function select($table_name, $columns = '*', $condition = 1)
    {
        return $this->queryTreatment("SELECT $columns FROM $table_name WHERE $condition");
    }

    public function insert($table_name, array $columns, array $values)
    {
        $columns_to_insert = implode(",", $columns);
        $values_to_insert = implode("','", $values);
        return $this->queryTreatment("INSERT INTO $table_name ($columns_to_insert) VALUES ('$values_to_insert')");
    }

    public function update($table_name, array $columns, array $values, $condition)
    {
        $combined_array = array_combine($columns, $values);
        foreach ($combined_array as $key => $value) {
            $combined_array[$key] = $key . "='" . $value . "'";
        }
        $string_to_set = implode(",", $combined_array);
        return $this->queryTreatment("UPDATE $table_name SET $string_to_set WHERE $condition");
    }

    public function delete($table_name, $condition)
    {
        return $this->queryTreatment("DELETE FROM $table_name WHERE $condition");
    }

}
