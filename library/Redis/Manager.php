<?php
final class Redis_Manager {
  private $_config = null;
 
  private static $_instance = null;

  private $_clientInstances = array();

  private function _prepareClient($name) {
    if(null === $this->_config) {
      throw new Exception('Config have to be set!');
    }

    $this->_clientInstances[$name] = new Redis();
    $this->_clientInstances[$name]->connect(
      $this->_config->servers->$name->ip,
      $this->_config->servers->$name->port
    );
  }
 
  public static function getInstance() {
    if(null === self::$_instance) {
      self::$_instance = new self();
    }

    return self::$_instance;
  }

  public function setConfig(Zend_Config $config) {
     $this->_config = $config;
  }

  public function get($name) {
    if(!array_key_exists($name, $this->_clientInstances)) {
      $this->_prepareClient($name);
    }

    return $this->_clientInstances[$name];
  }
}
?>

