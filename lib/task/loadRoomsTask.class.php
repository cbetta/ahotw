<?php

class loadRoomsTask extends sfBaseTask
{
	
  protected function configure()
  {
    // // add your own arguments here
    // $this->addArguments(array(
    //   new sfCommandArgument('my_arg', sfCommandArgument::REQUIRED, 'My argument'),
    // ));

    $this->addOptions(array(
      new sfCommandOption('application', null, sfCommandOption::PARAMETER_REQUIRED, 'The application name', 'frontend'),
      new sfCommandOption('env', null, sfCommandOption::PARAMETER_REQUIRED, 'The environment', 'dev'),
      new sfCommandOption('connection', null, sfCommandOption::PARAMETER_REQUIRED, 'The connection name', 'doctrine'),
      // add your own options here
    ));

    $this->namespace        = 'hotw';
    $this->name             = 'parse-rooms';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [hotw:parse-rooms|INFO] loads as much data about the HOTW objects as possible
Call it with:

  [php symfony hotw:parse-rooms|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
		// set_include_path(sfConfig::get('sf_lib_dir').'/vendor'.PATH_SEPARATOR.get_include_path());
		require_once sfConfig::get('sf_lib_dir').'/vendor/custom/simple_html_dom.php';
		
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

    //start parsing the data
    $this->parseRoomsAndFloors();
  }



	private function parseRoomsAndFloors() {
			$objects = Doctrine::getTable('Object')->findAll();
		
			foreach ($objects as $object) {
				$html = str_get_html(file_get_contents($object->getBmLink()));
				$found = false;
				foreach ($html->find('.bd p') as $p) {
					if ($found) break;;
					if (strpos($p->plaintext, 'Room') !== false) {
						$plural_pos = strpos($p->plaintext, 'Rooms');
						$single_pos = strpos($p->plaintext, 'Room');
						
						if ($plural_pos !== false) {
							$length = strpos($p->plaintext, ' ', $plural_pos+6)-$plural_pos;
							if ($length > 0) $val = substr($p->plaintext, $plural_pos, $length);
							else $val =  substr($p->plaintext, $plural_pos);
						}
						else {
							$length = strpos($p->plaintext, ' ', $single_pos+5)-$single_pos;
							if ($length > 0) $val = substr($p->plaintext, $single_pos, $length);
							else $val =  substr($p->plaintext, $single_pos);
						}
						
						$val = trim(str_replace(':', '', $val));
						
						$found = true;
						$this->logSection('Parsing', $val." for object ".$object->getNumber());
						$object->setRoom($val);
					}
					// 				$this->logSection('Parsing', 'Link: '.$link->href);
				}
				if (!$found) $this->logSection('Error', 'Not found for object: '.$object->getNumber());
				
				if ($found) {
					foreach ($html->find('.mediaBlock .arrowRight') as $link) {
						if ($link->href == '/visiting/floor_plans_and_galleries/upper_floor.aspx') {
							$object->setFloor('Upper Floor');
							$this->logSection('Floor', 'Upper Floor');
						}
						elseif($link->href == '/visiting/floor_plans_and_galleries/lower_floor.aspx') {
							$object->setFloor('Lower Floor');
							$this->logSection('Floor', 'Lower Floor');
						} elseif($link->href == '/visiting/floor_plans_and_galleries/ground_floor.aspx') {
							$object->setFloor('Ground Floor');
							$this->logSection('Floor', 'Ground Floor');
						}
					}
				}
				$object->save();
				
			}			
	}
	

}
