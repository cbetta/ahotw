<?php

/**
 * Object form base class.
 *
 * @method Object getObject() Returns the current form's model object
 *
 * @package    hotw100
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormGeneratedTemplate.php 29553 2010-05-20 14:33:00Z Kris.Wallsmith $
 */
abstract class BaseObjectForm extends BaseFormDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'number'      => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormInputText(),
      'name'        => new sfWidgetFormInputText(),
      'origin'      => new sfWidgetFormInputText(),
      'date'        => new sfWidgetFormInputText(),
      'img_link'    => new sfWidgetFormInputText(),
      'wp_link'     => new sfWidgetFormInputText(),
      'bbc_link'    => new sfWidgetFormInputText(),
      'bm_link'     => new sfWidgetFormInputText(),
      'audio_link'  => new sfWidgetFormInputText(),
      'transcript'  => new sfWidgetFormInputText(),
      'floor'       => new sfWidgetFormInputText(),
      'room'        => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->get('id')), 'empty_value' => $this->getObject()->get('id'), 'required' => false)),
      'number'      => new sfValidatorInteger(array('required' => false)),
      'description' => new sfValidatorPass(array('required' => false)),
      'name'        => new sfValidatorPass(array('required' => false)),
      'origin'      => new sfValidatorPass(array('required' => false)),
      'date'        => new sfValidatorPass(array('required' => false)),
      'img_link'    => new sfValidatorPass(array('required' => false)),
      'wp_link'     => new sfValidatorPass(array('required' => false)),
      'bbc_link'    => new sfValidatorPass(array('required' => false)),
      'bm_link'     => new sfValidatorPass(array('required' => false)),
      'audio_link'  => new sfValidatorPass(array('required' => false)),
      'transcript'  => new sfValidatorPass(array('required' => false)),
      'floor'       => new sfValidatorInteger(array('required' => false)),
      'room'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('object[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Object';
  }

}
