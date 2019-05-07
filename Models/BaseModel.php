<?php
/**
 * Created by PhpStorm.
 * User: Kotya
 * Date: 06.05.2019
 * Time: 11:56
 */

namespace Models;


use Components\App;
use Components\QueryBuilder;

class BaseModel
{

    /**
     * @var string
     */
    public static $tableName;

    /**
     * @var QueryBuilder
     */
    public $qb;

    public static function builder()
    {
        return new QueryBuilder(static::$tableName, App::app()->db->connection());
    }

    public static function insert(array $data = [])
    {
        return App::app()->db->insert(static::$tableName, $data);
    }

    public static function update($data, $where = [])
    {
        return App::app()->db->update(static::$tableName, $data, $where);
    }

    public static function delete($where)
    {
        static::beforeDelete($where);
        return App::app()->db->delete(static::$tableName, $where);
    }

    protected static function beforeDelete($where)
    {
    }
}