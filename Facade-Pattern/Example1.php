<?php
function getProductFileLines($file){
    return file($file);
}

function getProductObjectFromID($id,$productname){
    return new Product($id, $productname);
}

function getNameFromLine($line){
    if(preg_match("/.*-(.*)\s\d+/",$line,$array)){
        return str_replace('_',' ',$array[1]);
    }
    return '';
}

function getIDFromLine($line){
    if(preg_match("/^(\d{1,3})-/",$line,$array)){
        return $array[1];
    }
    return -1;
}

class Product{
    public $id;
    public $name;
    function __construct($id,$name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}

$lines = getProductFileLines('test.txt');
$objects = [];
foreach($lines as $line){
    $id = getIDFromLine($line);
    $name = getNameFromLine($line);
    $objects[$id] = getProductObjectFromID($id,$name);
}