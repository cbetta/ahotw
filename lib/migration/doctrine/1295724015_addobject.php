<?php
/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
class Addobject extends Doctrine_Migration_Base
{
    public function up()
    {
        $this->createTable('object', array(
             'id' => 
             array(
              'type' => 'integer',
              'length' => 8,
              'autoincrement' => true,
              'primary' => true,
             ),
             'number' => 
             array(
              'type' => 'integer',
              'length' => 8,
             ),
             'description' => 
             array(
              'type' => 'text',
              'length' => NULL,
             ),
             'name' => 
             array(
              'type' => 'varchar',
              'length' => 255,
             ),
             'origin' => 
             array(
              'type' => 'varchar',
              'length' => 255,
             ),
             'date' => 
             array(
              'type' => 'varchar',
              'length' => 255,
             ),
             'img_link' => 
             array(
              'type' => 'varchar',
              'length' => 255,
             ),
             'wp_link' => 
             array(
              'type' => 'varchar',
              'length' => 255,
             ),
             'bbc_link' => 
             array(
              'type' => 'varchar',
              'length' => 255,
             ),
             'bm_link' => 
             array(
              'type' => 'varchar',
              'length' => 255,
             ),
             'audio_link' => 
             array(
              'type' => 'varchar',
              'length' => 255,
             ),
             'transcript' => 
             array(
              'type' => 'varchar',
              'length' => 255,
             ),
             'floor' => 
             array(
              'type' => 'integer',
              'length' => 8,
             ),
             'room' => 
             array(
              'type' => 'varchar',
              'length' => 255,
             ),
             ), array(
             'type' => 'InnoDB',
             'indexes' => 
             array(
             ),
             'primary' => 
             array(
              0 => 'id',
             ),
             'collate' => 'utf8_unicode_ci',
             'charset' => 'utf8',
             ));
    }

    public function down()
    {
        $this->dropTable('object');
    }
}