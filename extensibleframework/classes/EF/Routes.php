<?php
namespace EF;


interface Routes
{
    public function getRoutes(): array;
    public function getAuthentication(): Authentication;
}