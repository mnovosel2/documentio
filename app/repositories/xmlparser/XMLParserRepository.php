<?php
namespace Documentio\Repositories\XMLParser;
use Nathanmac\Utilities\Parser\Facades\Parser;

class XMLParserRepository implements XMLParserInterface{
    public function parse($data){
       return Parser::xml($data);
    }
    public function getKey($key){
        return Parser::get($key);
    }
    public function hasKey($key){
        return Parser::has($key);
    }
}