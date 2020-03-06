<?php

/**
 * Description of ReminderClass 
 * representing a reminder 
 *
 * @author Michael Nirk
 */
require_once 'entity/EntityClass.php';

class ReminderClass extends EntityClass {
    
    //Class variables
    private $text;
    private $recipient_address;
    private $vehicle_name;
    private $title;
    private $reminder_date;
    
    function __construct(array $args = NULL) {
        if (!is_null($args) && !empty($args)) {
            if (!empty($args['text'])) {
                $this->text = $args['text'];
            }
            if (!empty($args['recipient_address'])) {
                $this->recipient_address = $args['recipient_address'];
            }
            if (!empty($args['vehicle_name'])) {
                $this->vehicle_name = $args['vehicle_name'];
            }
            if (!empty($args['title'])) {
                $this->title = $args['title'];
            }
            if (!empty($args['reminder_date'])) {
                $this->reminder_date = $args['reminder_date'];
            }
        }
    }
    
    public function getText() {
        return $this->text;
    }

    public function getRecipient_address() {
        return $this->recipient_address;
    }

    public function getVehicle_name() {
        return $this->vehicle_name;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getReminder_date() {
        return $this->reminder_date;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setRecipient_address($recipient_address) {
        $this->recipient_address = $recipient_address;
    }

    public function setVehicle_name($vehicle_name) {
        $this->vehicle_name = $vehicle_name;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setReminder_date($reminder_date) {
        $this->reminder_date = $reminder_date;
    }
}
