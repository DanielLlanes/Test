<?php
class Query
{
    private $dbHandler;
    private $statement;

    public function __construct(PDO $dbHandler)
    {
        $this->dbHandler = $dbHandler;
        if (!headers_sent()) {
            header('Content-Type: application/json');
            header('Access-Control-Allow-Origin: *');
        }
    }

    public function query(string $query, array $params = [])
    {
        $this->statement = $this->dbHandler->prepare($query);

        foreach ($params as $key => $value) {
            $this->bind($key, $value);
        }

        return $this;
    }

    public function bind($parameter, $value, $type = null)
    {
        if (is_null($type)) {
            switch (true) {
                case is_int($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }

        $this->statement->bindValue($parameter, $value, $type);
    }

    public function execute()
    {
        return $this->statement->execute();
        
    }
    public function create()
    {
        $result = $this->statement->execute();
        return $result ? $this->dbHandler->lastInsertId() : false;
    }

    public function resultSet()
    {
        $this->execute();
        $result = $this->statement->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($result);
    }

    public function single()
    {
        $this->execute();
        $result = $this->statement->fetch(PDO::FETCH_ASSOC);
        return $result ? json_encode($result) : null;
    }

    public function rowCount()
    {
        return $this->statement->rowCount();
    }
    
}