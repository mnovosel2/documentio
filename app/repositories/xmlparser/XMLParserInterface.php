<?php
    namespace Documentio\Repositories\XMLParser;
    interface XMLParserInterface{
        public function parse($data);
        public function getKey($key);
        public function hasKey($key);
    }