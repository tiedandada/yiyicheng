<?php
namespace app\index\controller;

class Index
{
    public function index()
    {
        return '</think>';
    }

    public function hello($name = '刘玉冰')
    {
        return 'hello,' . $name;
    }
    public function list()
    {
        return "哈哈哈哈";
    }
}
