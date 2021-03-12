<?php

namespace Core\Database;

use PDO;

abstract class QueryBuilder
{
    protected $pdo;
    protected $tableName;
    protected $where;
    protected $orderBy;
    protected $limit;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->tableName = $this->tableName ?? strtolower((new \ReflectionClass($this))->getShortName()).'s';
    }

    public function where($conditions)
    {
        $this->where = ' where '.implode(', ', $conditions);

        return $this;
    }

    public function orderBy($column, $order = 'ASC')
    {
        $this->orderBy = " order by $column $order";

        return $this;
    }

    public function limit($start, $end)
    {
        $this->limit = " limit {$start},{$end}";

        return $this;
    }

    public function selectAll($columns = [])
    {
        $fields = $columns ? implode(', ', $columns) : '*';
        $sql = "select $fields from {$this->tableName}";
        $statement = $this->executeStatement($sql);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function select($columns = [])
    {
        $fields = $columns ? implode(', ', $columns) : '*';
        $sql = $this->attachClauses("select $fields from {$this->tableName}");
        $statement = $this->executeStatement($sql);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function selectOne($columns = [])
    {
        $this->limit(0, 1);
        $fields = $columns ? implode(', ', $columns) : '*';
        $sql = $this->attachClauses("select {$fields} from {$this->tableName}");
        $statement = $this->executeStatement($sql);

        return $statement->fetchAll(PDO::FETCH_CLASS);
    }

    public function insert($parameters)
    {
        $sql = sprintf(
            'insert into %s (%s) values (%s)',
            $this->tableName,
            implode(', ', array_keys($parameters)),
            ':'.implode(', :', array_keys($parameters))
        );

        try {
            $this->executeStatement($sql, $parameters);
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function update($parameters)
    {
        $values = array_map(function ($key, $value) {
            return "{$key} = {$value}";
        }, array_keys($parameters), $parameters);
        $sql = $this->attachClauses(sprintf('update %s set %s', $this->tableName, implode(', ', $values)));

        try {
            return $this->executeStatement($sql);
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    public function delete()
    {
        $sql = $this->attachClauses("delete from {$this->tableName}");

        try {
            return $this->executeStatement($sql);
        } catch (\Exception $exception) {
            die($exception->getMessage());
        }
    }

    protected function executeStatement($sql, $parameters = [])
    {
        $statement = $this->pdo->prepare($sql);
        $statement->execute($parameters);

        return $statement;
    }

    protected function attachClauses($sql)
    {
        if ($this->where) {
            $sql .= $this->where;
        }
        if ($this->orderBy) {
            $sql .= $this->orderBy;
        }
        if ($this->limit) {
            $sql .= $this->limit;
        }

        return $sql;
    }
}
