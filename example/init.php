<?php
define('LIBRARY_PATH', realpath(dirname(__FILE__) . '/../library'));

set_include_path(implode(PATH_SEPARATOR, array(
  LIBRARY_PATH,
  get_include_path(),
)));
?>

