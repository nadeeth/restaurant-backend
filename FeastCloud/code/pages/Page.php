<?php

use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\ORM\FieldType\DBBoolean;

class Page extends SiteTree
{
    private static $db = [
        'ShowInFooterMenu' => DBBoolean::class
    ];

    private static $has_one = [
        'Banner' => Image::class
    ];

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', UploadField::create('Banner', 'Banner Image'));

        return $fields;
    }

    function getSettingsFields() {
        $fields = parent::getSettingsFields();
        $fields->addFieldToTab('Root.Settings', CheckboxField::create('ShowInFooterMenu', 'Show in Footer menu?'));
        return $fields;
    }
}
