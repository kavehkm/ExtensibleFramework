<?php
namespace Blog\Controllers;


use EF\DatabaseTable;


class CategoryController
{
    private $categoryTable;

    public function __construct(DatabaseTable $categoryTable)
    {
        $this->categoryTable = $categoryTable;
    }

    public function list()
    {
        $categories = [];
        $result = $this->categoryTable->findAll();
        foreach ($result as $category) {
            $categories[] = [
                'id'    => $category['cid'],
                'name'  => $category['name']
            ];
        }
        return [
            'title'     => 'categories',
            'template'  => 'blog/categories.html.php',
            'variables' => [
                'categories' => $categories
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