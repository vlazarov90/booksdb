<?php

namespace Models;

use DB\Connection;

class Book
{
    private $dbConn;

    /**
     * Book constructor.
     * @throws \Exception
     */
    public function __construct()
    {
        $this->dbConn = Connection::getInstance()->getConnection();
    }

    /**
     * @param $book
     * @param $author
     * @return false|resource
     *
     * Insert records in DB if record with same author and name exists -> update date
     */
    public function insert($book, $author)
    {
        $query = "INSERT INTO books (name, author) VALUES ($1, $2)
                  ON CONFLICT (name, author) DO UPDATE SET date=CURRENT_DATE
";
        return pg_query_params($this->dbConn, $query, [$book, $author]);
    }

    /**
     * @param $keyword
     * @return array
     */
    public function searchByAuthor($keyword)
    {
        $query = "SELECT * FROM books WHERE author ILIKE $1";

        $result = pg_query_params($this->dbConn, $query, ['%'.$keyword.'%']);
        return pg_fetch_all($result);
    }
}