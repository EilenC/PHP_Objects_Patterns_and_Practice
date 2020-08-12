<?php
$doc->encoding = 'UTF-8'; // insert proper

include "./Example1.php";
// 对Example1.php 里的调用进行一层封装
class ProductFacade {
    private $products  = [];
    function __construct($file)
    {
        $this->file = $file;
        $this->compile();
    }

    private function compile(){
        $lines = getProductFileLines($this->file);
        foreach($lines as $line){
            $id = getIDFromLine($line);
            $name = getNameFromLine($line);
            $this->products[$id] = getProductObjectFromID($id,$name);
        }
    }
    function getProducts(){
        return $this->products;
    }

    function getProduct($id){
        return $this->products[$id];
    }
}

$facade = new ProductFacade('test.txt');
$facade->getProduct(234);
