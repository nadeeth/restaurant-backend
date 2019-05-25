<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;

class MenuItemCategory extends DataObject
{
    private static $table_name = 'MenuItemCategory';

    private static $db = [
        'Title' => 'Varchar(150)'
    ];

    private static $has_many = [
        'MenuItems' => 'MenuItem'
    ];
}
