<?php
/**
 * Created by PhpStorm.
 * User: Sergey Ponidelnik
 * Date: 20/07/2018
 * Time: 13:22
 */

include_once 'Curl.php';
include_once 'Parser.php';
include_once 'Request.php';
include_once 'RequestFactory.php';

$parser = new Parser(new Curl(),new RequestFactory());
$response = $parser->parse('https://www.bing.com/search');
var_dump($response);