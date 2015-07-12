<?php
require_once '../config.php';
require_once ROOT_PATH . '/models/Parser.php';
require_once ROOT_PATH . '/models/Database.php';
require_once ROOT_PATH . '/models/Animal.php';

$parser_obj = new \models\Parser($dir_path);
$xml_content = $parser_obj->writeXMLInDB();

echo json_encode($xml_content);
