<?php

namespace Components;


class DB
{

    /**
     * @var \mysqli
     */
    protected $connection;

    public function __construct($host = '', $user = '', $password = '', $database = '', $port = '')
    {
        $this->connection = mysqli_connect($host, $user, $password, $database, $port);
    }

    /**
     * @return \mysqli
     */
    public function connection()
    {
        return $this->connection;
    }

    public function insert(string $table, array $data)
    {
        $query = 'INSERT INTO `' . $this->escape($table) . '` ';
        $query .= $this->queryFieldsString(array_keys($data));
        $query .= 'VALUES ' . $this->queryValuesString(array_values($data));

        return $this->connection()->query($query);
    }

    public function update(string $table, array $data, array $where = [])
    {
        $query = 'UPDATE `' . $this->escape($table) . '` ';
        $query .= 'SET ' . $this->queryUpdateSetString($data);
        $query .= 'WHERE ' . $this->queryConditionString($where);
        return $this->connection()->query($query);
    }

    public function delete(string $table, array $where)
    {
        $query = 'DELETE FROM `' . $this->escape($table) . '` ';
        $query .= 'WHERE ' . $this->queryConditionString($where);
        return $this->connection()->query($query);
    }

    public function queryUpdateSetString(array $data = [])
    {
        $query = '';
        foreach ($data as $field => $value) {

            $query .= '`' . $this->escape($field) . '` = ';
            $query .= '\'' . $this->escape($value) . '\' ';

            $query .= ', ';
        }

        return mb_substr($query, 0, mb_strlen($query) - 2);
    }

    public function queryFieldsString($fields)
    {
        $query = '(';
        for ($i = 0; $i < count($fields); $i++) {
            $field = $fields[$i];
            $query .= '`' . $this->escape($field) . '`';

            if ($i < count($fields) - 1) {
                $query .= ', ';
            }
        }

        return $query . ') ';
    }

    protected function queryConditionString($data)
    {
        $query = '';
        foreach ($data as $field => $value) {

            $query .= '`' . $this->escape($field) . '` = ';
            $query .= '\'' . $this->escape($value) . '\' ';

            $query .= 'AND ';
        }

        return mb_substr($query, 0, mb_strlen($query) - 4);
    }


    public function queryValuesString($values)
    {
        $query = '(';
        for ($i = 0; $i < count($values); $i++) {
            $value = $values[$i];
            $query .= '\'' . $this->escape($value) . '\'';

            if ($i < count($values) - 1) {
                $query .= ', ';
            }
        }

        return $query . ') ';
    }

    protected function escape($string)
    {
        return mysqli_real_escape_string($this->connection(), $string);
    }
}