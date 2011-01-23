<?php

/**
 * Object filter form base class.
 *
 * @package    hotw100
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfDoctrineFormFilterGeneratedTemplate.php 29570 2010-05-21 14:49:47Z Kris.Wallsmith $
 */
abstract class BaseObjectFormFilter extends BaseFormFilterDoctrine
{
  public function setup()
  {
    $this->setWidgets(array(
      'number'      => new sfWidgetFormFilterInput(),
      'description' => new sfWidgetFormFilterInput(),
      'name'        => new sfWidgetFormFilterInput(),
      'origin'      => new sfWidgetFormFilterInput(),
      'date'        => new sfWidgetFormFilterInput(),
      'img_link'    => new sfWidgetFormFilterInput(),
      'origin_link' => new sfWidgetFormFilterInput(),
      'wp_link'     => new sfWidgetFormFilterInput(),
      'bbc_link'    => new sfWidgetFormFilterInput(),
      'bm_link'     => new sfWidgetFormFilterInput(),
      'audio_link'  => new sfWidgetFormFilterInput(),
      'transcript'  => new sfWidgetFormFilterInput(),
      'floor'       => new sfWidgetFormFilterInput(),
      'room'        => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'number'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'description' => new sfValidatorPass(array('required' => false)),
      'name'        => new sfValidatorPass(array('required' => false)),
      'origin'      => new sfValidatorPass(array('required' => false)),
      'date'        => new sfValidatorPass(array('required' => false)),
      'img_link'    => new sfValidatorPass(array('required' => false)),
      'origin_link' => new sfValidatorPass(array('required' => false)),
      'wp_link'     => new sfValidatorPass(array('required' => false)),
      'bbc_link'    => new sfValidatorPass(array('required' => false)),
      'bm_link'     => new sfValidatorPass(array('required' => false)),
      'audio_link'  => new sfValidatorPass(array('required' => false)),
      'transcript'  => new sfValidatorPass(array('required' => false)),
      'floor'       => new sfValidatorPass(array('required' => false)),
      'room'        => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('object_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->setupInheritance();

    parent::setup();
  }

  public function getModelName()
  {
    return 'Object';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'number'      => 'Number',
      'description' => 'Text',
      'name'        => 'Text',
      'origin'      => 'Text',
      'date'        => 'Text',
      'img_link'    => 'Text',
      'origin_link' => 'Text',
      'wp_link'     => 'Text',
      'bbc_link'    => 'Text',
      'bm_link'     => 'Text',
      'audio_link'  => 'Text',
      'transcript'  => 'Text',
      'floor'       => 'Text',
      'room'        => 'Text',
    );
  }
}
