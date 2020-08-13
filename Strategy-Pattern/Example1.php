<?php

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

class MarkLogicMarker extends Marker{
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

$markers = [
    new RegexpMarker("/f.ve/"),
    new MatchMarker("five"),
    new MarkLogicMarker('$input equals "five"')
];

foreach($markers as $marker)
{
    print get_class($marker)."\n";
    $question = new TextQuestion("how many beans make five",$marker);
    foreach(["five","four"] as $response){
        print "\tresponse:$response:";
        if($question->mark($response)){
            print "well done\n";
        }else{
            print "never mind\n";
        }
    }
}