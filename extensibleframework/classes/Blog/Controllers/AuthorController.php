<?php
namespace Blog\Controllers;


use EF\DatabaseTable;


class AuthorController
{
    private $authorTable;

    public function __construct(DatabaseTable $authorTable)
    {
        $this->authorTable = $authorTable;
    }

    public function list()
    {
        $authors = [];
        $result = $this->authorTable->findAll();
        foreach ($result as $author) {
            $authors[] = [
                'id'    => $author['aid'],
                'fname' => $author['fname'],
                'lname' => $author['lname'],
                'email' => $author['email']
            ];
        }
        return [
            'title'     => 'authors',
            'template'  => 'blog/authors.html.php',
            'variables' => [
                'authors' => $authors
            ]
        ];
    }

    public function edit()
    {

    }

    public function delete()
    {

    }
}