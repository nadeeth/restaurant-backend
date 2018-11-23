<?php

use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;

class HomePage extends Page
{
    private static $db = [];

    private static $has_one = [
        'Background' => Image::class
    ];

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', UploadField::create('Background', 'Background Image'));
        $fields->removeByName('Banner');

        return $fields;
    }
}
