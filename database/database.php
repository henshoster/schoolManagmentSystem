<?php
abstract class DataBase
{
    const HOST = 'den1.mysql3.gear.host';
    const USERNAME = 'project0001';
    const PASSWORD = 'Ev4RgGf-!6vf';
    const DATABASE_NAME = 'project0001';

    protected $db;
    public function __construct($host = self::HOST, $username = self::USERNAME, $password = self::PASSWORD, $databasename = self::DATABASE_NAME)
    {
        $this->db = new mysqli($host, $username, $password);
        //if not exists, creating new database for The school under the name 'project';
        if ($this->db->select_db($databasename) === false) {
            $this->queryTreatment("CREATE DATABASE IF NOT EXISTS $databasename CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_520_ci");
            $this->db->select_db($databasename);
            $this->queryTreatment("CREATE TABLE IF NOT EXISTS `administrators` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `role` VARCHAR(20) NOT NULL , `phone` VARCHAR(20) NOT NULL , `email` VARCHAR(50) NOT NULL , `password` VARCHAR(255) NOT NULL , `image_src` TEXT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`email`)) ENGINE = InnoDB");
            $ownerPassword = password_hash('admin', PASSWORD_DEFAULT);
            $ownerColumns = ['id', 'name', 'role', 'phone', 'email', 'password', 'image_src'];
            $ownerValues = [null, 'Bill Gates', 'owner', '050-1234567', 'admin@theschool.com', "$ownerPassword", 'images/user.png'];
            $this->insert('administrators', $ownerColumns, $ownerValues);
            $this->queryTreatment("CREATE TABLE IF NOT EXISTS `courses` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `description` TEXT NOT NULL , `image_src` TEXT NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB");
            $this->queryTreatment("CREATE TABLE IF NOT EXISTS `students` ( `id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(50) NOT NULL , `phone` VARCHAR(20) NOT NULL , `email` VARCHAR(50) NOT NULL , `image_src` TEXT NOT NULL , PRIMARY KEY (`id`), UNIQUE (`email`)) ENGINE = InnoDB");
            $this->queryTreatment("CREATE TABLE IF NOT EXISTS `students2courses` ( `students_id` INT NOT NULL , `courses_id` INT NOT NULL ) ENGINE = InnoDB");
            $this->queryTreatment("ALTER TABLE `students2courses` ADD UNIQUE (`students_id`, `courses_id`)");
        }
        if ($this->db->connect_error) {
            echo "<pre>";
            var_dump($this->db);
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
