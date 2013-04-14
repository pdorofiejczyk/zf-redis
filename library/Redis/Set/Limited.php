<?php
class Redis_Set_Limited extends Redis_Set_Sorted {
  private $_limit = null;

  public function __construct(Redis $redisClient, $setName, $limit) {
    parent::__construct($redisClient, $setName);
    $this->_limit = $limit;
  }

  public function add($value, $score) {
    return $this->getRedisClient()->multi()
      ->zAdd($this->_getSetName(), $score, $value)
      ->zRemRangeByRank($this->_getSetName(), 0, -$this->_getLimit()-1)
      ->exec(); 
  }

  protected function _getLimit() {
    return $this->_limit;
  }
}
?>

