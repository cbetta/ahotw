<?php

class loadTranscriptPagesTask extends sfBaseTask
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
    $this->name             = 'parse-transcripts';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [hotw:parse-bbc|INFO] loads as much data about the HOTW objects as possible
Call it with:

  [php symfony hotw:parse-bbc|INFO]
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
    $this->parseTranscripts();
  }
	
	private function parseTranscripts() {
		foreach (Doctrine::getTable('Object')->findAll() as $object) {			
			$html = str_get_html(file_get_contents(sfConfig::get('app_urls_transcript_base').$object->getNumber()."/"));
			$transcript = array();
			foreach ($html->find('.col-a p') as $paragraph) {
				$transcript[] = $paragraph->plaintext;
			}
			$transcript = join('\n', $transcript);
			$object->setTranscript($transcript);
			$object->save();
			$this->logSection('Parsing', 'Transcript: '.$transcript);
			
		}
	}
	

}

