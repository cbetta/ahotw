<?php

/**
 * mobile actions.
 *
 * @package    hotw100
 * @subpackage mobile
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class mobileActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
		$this->objects = $this->getRoute()->getObjects();
		sfConfig::set('sf_web_debug', false);
  }

	public function executeShow(sfWebRequest $request) {
		$this->object = $this->getRoute()->getObject();
		sfConfig::set('sf_web_debug', false);
		
	}
	
	public function executeTranscript(sfWebRequest $request) {
		$this->object = $this->getRoute()->getObject();
		sfConfig::set('sf_web_debug', false);
		
	}
}
