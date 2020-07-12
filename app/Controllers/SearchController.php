<?php


namespace Controllers;

use Lib\View;
use Models\Book;

class SearchController
{
    /**
     * Search action
     */
    public function search()
    {
        $view = new View();
        $view->setTitle('books');
        $view->keyword = '';

        if(isset($_GET['search'])){
            $book = new Book();

            $books = $book->searchByAuthor($_GET['search']);

            $view->books = $books;
            $view->keyword = $_GET['search'];
        }

        echo $view->render('search');
    }
}