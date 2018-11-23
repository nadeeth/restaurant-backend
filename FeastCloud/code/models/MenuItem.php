<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;

class MenuItem extends DataObject
{
    private static $table_name = 'MenuItem';

    private static $db = [
        'Title' => 'Varchar(150)',
        'Description' => 'Text',
        'Price' => 'Decimal'
    ];

    private static $has_one = [
        'Image' => Image::class,
        'MenuPage' => 'MenuPage'
    ];

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', UploadField::create('Image'));
        $fields->removeByName('MenuPage');

        return $fields;
    }
}
