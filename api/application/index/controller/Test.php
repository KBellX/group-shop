<?php
namespace app\index\controller;

class Test
{
    public function index()
    {
        return 'aaaa';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }
}
