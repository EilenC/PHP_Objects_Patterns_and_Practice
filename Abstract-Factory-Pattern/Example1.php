<?php

abstract class CommManager
{
    abstract function getHeaderText();
    abstract function getApptEncoder();
    abstract function getTtdEncoder();
    abstract function getContactEncoder();
    abstract function getFooterText();
}

class BloggsCommsManager extends CommManager
{
    function getHeaderText()
    {
        return "BloggsCal header\n";
    }
    function getApptEncoder()
    {
        return new BloggsApptEncoder();
    }

    function getTtdEncoder()
    {
        return new BloggsTtdEncoder();
    }

    function getContactEncoder()
    {
        return new BloggsContactEncoder();
    }

    function getFooterText()
    {
        return "BloggsCal footer\n";
    }
}
