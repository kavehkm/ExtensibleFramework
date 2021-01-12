<?php
namespace Blog;


use EF\Routes;
use EF\DatabaseTable;
use Blog\Controllers\PostController;
use Blog\Controllers\CategoryController;
use Blog\Controllers\AuthorController;


class BlogRoutes implements Routes
{
    public function getRoutes()
    {
        // database connection: pdo
        include __DIR__ . '/../../includes/DatabaseConnection.php';

        // tables
        $postTable = new DatabaseTable($pdo, 'post', 'pid');
        $authorTable = new DatabaseTable($pdo, 'author', 'aid');
        $categoryTable = new DatabaseTable($pdo, 'category', 'cid');

        // controllers
        $postController = new PostController($postTable, $categoryTable, $authorTable);
        $categoryController = new CategoryController($categoryTable);
        $authorController = new AuthorController($authorTable);

        return [
            // home
            'home' => [
                'GET' => [
                    'controller'    => $postController,
                    'action'        => 'list'
                ]
            ],
            // post
            'post/list' => [
                'GET' => [
                    'controller'    => $postController,
                    'action'        => 'list'
                ]
            ],
            'post/get' => [
                'GET' => [
                    'controller'    => $postController,
                    'action'        => 'get'
                ]
            ],
            'post/edit' => [
                'GET' => [
                    'controller'    => $postController,
                    'action'        => 'edit'
                ],
                'POST' => [
                    'controller'    => $postController,
                    'action'        => 'edit'
                ]
            ],
            'post/delete' => [
                'POST' => [
                    'controller'    => $postController,
                    'action'        => 'delete'
                ]
            ],
            // category
            'category/list' => [
                'GET' => [
                    'controller'    => $categoryController,
                    'action'        => 'list'
                ]
            ],
            'category/edit' => [
                'GET' => [
                    'controller'    => $categoryController,
                    'action'        => 'edit'
                ],
                'POST' => [
                    'controller'    => $categoryController,
                    'action'        => 'edit'
                ]
            ],
            'category/delete' => [
                'POST' => [
                    'controller'    => $categoryController,
                    'action'        => 'delete'
                ]
            ],
            // author
            'author/list' => [
                'GET' => [
                    'controller'    => $authorController,
                    'action'        => 'list'
                ]
            ],
            'author/edit' => [
                'GET' => [
                    'controller'    => $authorController,
                    'action'        => 'edit'
                ],
                'POST' => [
                    'controller'    => $authorController,
                    'action'        => 'edit'
                ]
            ],
            'author/delete' => [
                'POST' => [
                    'controller'    => $authorController,
                    'action'        => 'delete'
                ]
            ]
        ];
    }
}