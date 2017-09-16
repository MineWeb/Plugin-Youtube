<?php

class YoutubeConfiguration extends YoutubeAppModel {
  public $useTable = 'youtube';

  public function getConfig() {
    $config = $this->find('first');
    if(empty($config)) {
      return true;
    }
  }
}
