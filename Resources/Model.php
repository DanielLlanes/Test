<?php

class Model
{
    protected $connection;
    protected $query;

    public function __construct() {
        $this->connection = Connection::connect();
        $this->query = new Query($this->connection);
    }
}