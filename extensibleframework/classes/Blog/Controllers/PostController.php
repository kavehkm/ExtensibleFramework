<?php
namespace Blog\Controllers;


use EF\DatabaseTable;


class PostController
{
    private $postTable;
    private $categoryTable;
    private $authorTable;

    public function __construct(DatabaseTable $postTable, DatabaseTable $categoryTable, DatabaseTable $authorTable)
    {
        $this->postTable = $postTable;
        $this->categoryTable = $categoryTable;
        $this->authorTable = $authorTable;
    }

    public function list()
    {
        $posts = [];
        $result = $this->postTable->findAll();
        foreach ($result as $post) {
            $author = $this->authorTable->findById($post['author']);
            $category = $this->categoryTable->findById($post['category']);
            $posts[] = [
                'id'        => $post['pid'],
                'title'     => $post['title'],
                'content'   => $post['content'],
                'author'    => $author['email'],
                'category'  => $category['name']
            ];
        }
        return [
            'title'     => 'posts',
            'template'  => 'blog/posts.html.php',
            'variables' => [
                'posts' => $posts,
                'total' => $this->postTable->total()
            ]
        ];
    }

    public function get()
    {
        $post = [];
        $id = $_GET['id'];
        $result = $this->postTable->findById($id);
        if (!empty($result)) {
            $author = $this->authorTable->findById($result['author']);
            $category = $this->categoryTable->findById($result['category']);
            $post = [
                'id'        => $result['pid'],
                'title'     => $result['title'],
                'content'   => $result['content'],
                'author'    => $author['email'],
                'category'  => $category['name']
            ];
        }
        return [
            'title'     => 'post details',
            'template'  => 'blog/post.html.php',
            'variables' => [
                'post' => $post
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