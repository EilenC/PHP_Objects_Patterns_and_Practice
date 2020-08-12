<?php

abstract class CommManager
{
    const APPT = 1;
    const TTD = 2;
    const CONTACT = 3;

    abstract function getHeaderText();
    abstract function make($flag_int);
    abstract function getFooterText();
}

class BloggsCommsManager extends CommManager
{
    function getHeaderText()
    {
        return "BloggsCal header\n";
    }

    function make($flag_int)
    {
        switch ($flag_int) {
            case self::APPT:
                return new BloggsApptEncoder();
            case self::TTD:
                return new BloggsTtdEncoder();
            case self::CONTACT:
                return new BloggsContactEncoder();
        }
    }
    
    function getFooterText()
    {
        return "BloggsCal footer\n";
    }
}
