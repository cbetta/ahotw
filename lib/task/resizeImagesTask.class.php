<?php

class resizeImagesTask extends sfBaseTask
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
    $this->name             = 'resize-images';
    $this->briefDescription = '';
    $this->detailedDescription = <<<EOF
The [hotw:resize-images|INFO] loads as much data about the HOTW objects as possible
Call it with:

  [php symfony hotw:resize-images|INFO]
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
    $this->resizeImages();
  }



	private function resizeImages() {
		foreach (Doctrine::getTable('Object')->findAll() as $object) {
				$this->logSection('Resizing', $object->getId());
				$this->logSection('Resizing', $object->getImgLink());
				
				$target = sfConfig::get('sf_web_dir')."/objects/".$object->getId().".jpg";
				
				$rh = fopen($object->getImgLink(), 'rb');
        $wh = fopen($target, 'wb');

        if ($rh===false || $wh===false) {
           continue;
        }
        while (!feof($rh)) {
            if (fwrite($wh, fread($rh, 1024)) === FALSE) {
                   return true;
               }
        }
        fclose($rh);
        fclose($wh);

				$img = new sfImage($target, 'image/jpg');

				$img->thumbnail(80,80, 'center');
				$img->saveAs($target);
				
		}
	}
	

}
