<?php

/**
 * Description of Entity
 *
 * @author Michael Nirk
 */
class EntityClass {
  
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

  public function getPropertiesArray() {
    $propertiesArray = array();
    $reflection = new ReflectionClass(get_class($this));
    $classProps = $reflection->getProperties();
    foreach ($classProps as $prop) {
      $propName = $prop->getName();
      if (is_array($this->$propName)) {
        $props = array();
        foreach ($this->$propName as $item) {
          if ($item instanceof EntityClass) {
            $props[] = $item->getPropertiesArray();
          } else {
            $props[] = $item;
          }
        }
        $propertiesArray[$propName] = $props;
      } else {
        $propertiesArray[$propName] = $this->$propName;
      }
    }
    return $propertiesArray;
  }

}
