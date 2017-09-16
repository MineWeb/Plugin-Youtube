<?php
class YoutubeAppSchema extends CakeSchema {

    public $file = 'schema.php';

    public function before($event = array()) {
        return true;
    }

    public function after($event = array()) {}

  public $youtube__youtube = array(
	  'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => false, 'key' => 'primary'),
	  'url' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 200),
	  'highlighted' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 1, 'unsigned' => false),
	  'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
  );

}
