<?php

class loadDataTask extends sfBaseTask
{
	private $wikipedia_table_map = array(
		0 => 'parseImage',
		1 => 'parseNumber',
		2 => 'parseObject',
		3 => 'parseOrigin',
		4 => 'parseDate',
		5 => 'parseBBCLink',
		6 => 'parseBMLink',
		7 => '_skip'
	);
	
	
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
    $this->name             = 'load-data';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [hotw:load-data|INFO] loads as much data about the HOTW objects as possible
Call it with:

  [php symfony hotw:load-data|INFO]
EOF;
  }

  protected function execute($arguments = array(), $options = array())
  {
		// set_include_path(sfConfig::get('sf_lib_dir').'/vendor'.PATH_SEPARATOR.get_include_path());
		require_once sfConfig::get('sf_lib_dir').'/vendor/custom/simple_html_dom.php';
		
    // initialize the database connection
    $databaseManager = new sfDatabaseManager($this->configuration);
    $connection = $databaseManager->getDatabase($options['connection'])->getConnection();

		//remove all db
		Doctrine::getTable('Object')->findAll()->delete();

    //start parsing the data
		$this->parseWikipedia();
  }

	private function parseWikipedia() {
		$this->logSection('Fetching', sfConfig::get('app_urls_wikipedia_list'));
		$html = str_get_html(file_get_contents(sfConfig::get('app_urls_wikipedia_list')));
		//parse each table
		foreach ($html->find('.wikitable') as $i => $table) {
			$this->logSection('Parsing', 'Table '.$i);
      $this->parseTable($table);
		}
	}

	private function parseTable($table) {
		foreach ($table->find('tr') as $row_id => $row) {
			if ($row_id == 0) continue;
			
			$this->logSection('Parsing', 'Row '.$row_id);
			
			$object = new Object();
			
			foreach ($row->find('td') as $cell_id => $cell) {
				$this->logSection('Parsing', 'Cell '.$cell_id);
				$method = $this->wikipedia_table_map[$cell_id];
				if ($method !== '_skip') $this->$method($cell, &$object);
			}
			
			$object->save();
		}
	}
	
	private function parseImage($cell, $object) {
		if ($cell->firstChild()) {
			$object->setImgLink($cell->firstChild()->firstChild()->src);
			$this->logSection('Parsing', 'Image: '.$object->getImgLink());
		}
	}
	
	private function parseNumber($cell, $object) {
		$object->setNumber($cell->plaintext);
		$this->logSection('Parsing', 'Number: '.$object->getNumber());
	}
	
	private function parseObject($cell, $object) {
		$object->setName($cell->plaintext);
		$this->logSection('Parsing', 'Name: '.$object->getName());
		
		if ($cell->firstChild()) {
			$object->setWpLink("http://en.wikipedia.org".$cell->firstChild()->href);
			$this->logSection('Parsing', 'WP Link: '.$object->getWpLink());
		}
	}
	
	private function parseOrigin($cell, $object) {
		$object->setOrigin($cell->plaintext);
		$this->logSection('Parsing', 'Origin: '.$object->getOrigin());
		
		if ($cell->firstChild()) {
			$object->setOriginLink("http://en.wikipedia.org".$cell->firstChild()->href);
			$this->logSection('Parsing', 'Origin Link: '.$object->getOriginLink());
		}
	}
	
	private function parseDate($cell, $object) {
		$object->setDate($cell->plaintext);
		$this->logSection('Parsing', 'Date: '.$object->getDate());
	}
	
	private function parseBBCLink($cell, $object) {
		if ($cell->firstChild()) {
			$object->setBbcLink($cell->firstChild()->href);
			$this->logSection('Parsing', 'BBC Link: '.$object->getBbcLink());
		}
	}
	
	private function parseBMLink($cell, $object) {
		if ($cell->firstChild()) {
			$object->setBmLink($cell->firstChild()->href);
			$this->logSection('Parsing', 'BBC Link: '.$object->getBmLink());
		}
	}
}
