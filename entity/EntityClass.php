<?php

/**
 * Description of Entity
 *
 * @author Michael Nirk
 */
class EntityClass {

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
