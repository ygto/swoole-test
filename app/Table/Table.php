<?php


namespace App\Table;


class Table
{

    protected $tables = [];

    public function __construct($tables)
    {

        foreach ($tables as $tableName => $tableData) {
            $table = new \Swoole\Table((int)$tableData['size']);
            foreach ($tableData['fields'] as $tableField) {
                $table->column($tableField['name'], $tableField['type'], $tableField['type'] ?? null);
            }

            $table->create();
            $this->tables[$tableName] = $table;
        }
    }

    public function get($name)
    {
        return $this->tables[$name] ?? null;
    }
}