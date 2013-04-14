<?php
abstract class Redis_Abstract {
  private $_redisClient = null;

  public function __construct(Redis $redisClient) {
    $this->_redisClient = $redisClient;
  }

  public function getRedisClient() {
    return $this->_redisClient;
  }
}
?>

