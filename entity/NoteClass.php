<?php
require_once 'entity/EntityClass.php';

class NoteClass extends EntityClass {
  protected $note_id;
  protected $note_text;
  protected $parent_id;
  protected $create_datetime;

  public function __construct($properties = null) {
    if ($properties) {
      $reflection = new ReflectionClass(get_class($this));
      $classProps = $reflection->getProperties();
      foreach ($classProps as $prop) {
        $propName = $prop->getName();
        if (isset($properties[$propName])) {
          $this->$propName = $properties[$propName];
        }
      }
    }
  }

  /**
   * @return mixed
   */
  public function getNoteID() {
    return $this->note_id;
  }

  /**
   * @param mixed $note_id
   */
  public function setNoteID($note_id) {
    $this->note_id = $note_id;
  }

  /**
   * @return mixed
   */
  public function getNoteText() {
    return $this->note_text;
  }

  /**
   * @param mixed $note_text
   */
  public function setNoteText($note_text) {
    $this->note_text = $note_text;
  }

  /**
   * @return mixed
   */
  public function getParentID() {
    return $this->parent_id;
  }

  /**
   * @param mixed $parent_id
   */
  public function setParentID($parent_id) {
    $this->parent_id = $parent_id;
  }

  /**
   * @return mixed
   */
  public function getCreateDatetime() {
    return $this->create_datetime;
  }

  /**
   * @param mixed $create_datetime
   */
  public function setCreateDatetime($create_datetime) {
    $this->create_datetime = $create_datetime;
  }
}