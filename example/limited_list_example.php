<?php
require_once 'init.php';

require_once 'Zend/Config/Ini.php';
require_once 'Redis/Manager.php';
require_once 'Redis/Abstract.php';
require_once 'Redis/Set/Sorted.php';
require_once 'Redis/Set/Limited.php';

$manager = Redis_Manager::getInstance();
$manager->setConfig(new Zend_Config_Ini('example_config.ini'));
$client = $manager->get('example');

$set = new Redis_Set_Limited($client, 'limited_list_example', 5);

for($score = 0; $score < 10; $score++) {
  $set->add('value' . $score, $score);
}

print_r($set->get(0, 10, false));
?>

