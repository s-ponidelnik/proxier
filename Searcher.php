<?php
/**
 * Created by PhpStorm.
 * User: Sergey Ponidelnik
 * Date: 20/07/2018
 * Time: 16:41
 */

include_once 'interface/SearcherInterface.php';

abstract class Searcher implements SearcherInterface
{
    private $parser;

    public function __construct(ParserInterface $parser)
    {
        $this->parser = $parser;
    }
    protected function getParser():ParserInterface
    {
        return $this->parser;
    }
    abstract function search(array $keywords): array;
}