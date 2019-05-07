<?php

namespace Components;


class QueryBuilder
{

    /**
     * @var string
     */
    protected $tableName;

    /**
     * @var \mysqli
     */
    protected $connection;
    
    protected $orders = [];

    protected $conditions = [];

    public function where($field, $value, $type = 'and')
    {
        $this->conditions[] = [
            'value' => $value,
            'field' => $field,
            'type' => $type
        ];
        return $this;
    }

    public function whereArray($data)
    {
        foreach ($data as $field => $value) {
            $this->where($field, $value);
        }
        return $this;
    }

    public function order($field, $sort = 'asc')
    {
        $this->orders[] = [
            'sort' => $sort,
            'field' => $field
        ];
        return $this;
    }

    public function fetch()
    {
        $query = 'SELECT * FROM ' . $this->escape($this->tableName). ' ';
        $query .= $this->queryConditionString();
        $query .= $this->queryOrderString();

        return $this->connection->query($query)
            ->fetch_all(MYSQLI_ASSOC);
    }

    public function escape($string)
    {
        return mysqli_real_escape_string($this->connection ,$string);
    }

    /**
     * Возвращается SQL строку для конструкции WHERE
     *
     * @return string
     */
    protected function queryConditionString()
    {
        if (empty($this->conditions)) {
            return '';
        }

        $query = 'WHERE ';
        for ($i = 0; $i < count($this->conditions); $i++) {
            $condition = $this->conditions[$i];
            $query .= '`' . $this->escape($condition['field']) . '` = ';
            $query .= '\'' . $this->escape($condition['value']) . '\' ';

            if ($i < count($this->conditions) - 1) {
                $query .= $condition['type'] . ' ';
            }
        }

        return $query . ' ';
    }

    /**
     * Возвращается SQL строку для конструкции ORDER BY
     *
     * @return string
     */
    protected function queryOrderString()
    {
        if (empty($this->orders)) {
            return '';
        }

        $query = 'ORDER BY ';
        foreach ($this->orders as $order) {

            $query .= '`' . $this->escape($order['field']) . '` ';
            $query .= $this->escape($order['sort']);
            $query .= ', ';

        }

        return mb_substr($query, 0, mb_strlen($query) - 2);
    }

    public function __construct($tableName, $connection)
    {
        $this->tableName = $tableName;
        $this->connection = $connection;
    }

}