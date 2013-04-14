<?php
class Redis_Set_Sorted extends Redis_Abstract {
  private $_setName = null;

  public function __construct(Redis $redisClient, $setName) {
    parent::__construct($redisClient);
    $this->_setName = $setName;
  }

  public function add($value, $score) {
    return $this->getRedisClient()->zAdd($this->_getSetName(), $score, $value);
  }

  public function remove($value) {
    return $this->getRedisClient()->zRem($this->_getSetName(), $value);
  }

  public function get($start, $end, $revOrder = true) {
    if($revOrder) {
      return $this->getRedisClient()->zRevRange($this->_getSetName(), $start, $end, true);
    }
    else {
      return $this->getRedisClient()->zRange($this->_getSetName(), $start, $end, true);
    }
  }

  protected function _getSetName() {
    return $this->_setName;
  }
}
?>

