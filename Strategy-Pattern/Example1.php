<?php

use think\db\Query;

abstract class Question {
    protected $prompt;
    protected $marker;

    function __construct($prompt,Marker $marker)
    {
        $this->prompt = $prompt;
        $this->marker = $marker;
    }

    function mark($response){
        return $this->marker->mark($response);
    }
}

class TextQuestion extends Question{
    //处理文本操作
}

class AVQuestion extends Question{
    //处理语音相关
}

abstract class Marker {
    protected $test;

    function __construct($test)
    {
        $this->test = $test;
    }

    abstract function mark($response);
}

abstract class MarkLogicMarker extends Marker{
    private $engine;

    function __construct($test)
    {
        parent::__construct($test);
    }

    function mark($response){
        return true;
    }
}

class MatchMarker extends Marker{
    function mark($response){
        return ($this->test == $response);
    }
}

class RegexpMarker extends Marker{
    function mark($response){
        return (preg_match($this->test,$response));
    }
}