<?php

use SilverStripe\Forms\TextField;

class ContactPage extends Page
{
    private static $db = [
        'To' => 'Varchar(120)'
    ];

    private static $has_one = [];

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', TextField::create('To', 'To Address (separate by spaces if you have many)'));

        return $fields;
    }
}
