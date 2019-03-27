<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Assets\Image;
use SilverStripe\AssetAdmin\Forms\UploadField;

class CustomSiteConfig extends DataExtension 
{

    private static $db = [
        'SendOrdersTo' => 'Varchar(50)',
        'OrderTax' => 'Decimal',
        'OrderDiscount' => 'Decimal',
        'RestaurantConfirmedEmailSubject' => 'Varchar(100)',
        'RestaurantConfirmedEmailBody' => 'HTMLText',
        'ReadyToPickUpEmailSubject' => 'Varchar(100)',
        'ReadyToPickUpEmailBody' => 'HTMLText',
    ];

    private static $has_one = [
        'Logo' => Image::class
    ];

    public function updateCMSFields(FieldList $fields) 
    {
        $fields->addFieldToTab('Root.Main', UploadField::create('Logo'));
        $fields->addFieldToTab("Root.Orders", new TextField("SendOrdersTo"));
        $fields->addFieldToTab("Root.Orders", new TextField("OrderTax"));
        $fields->addFieldToTab("Root.Orders", new TextField("OrderDiscount"));
        $fields->addFieldToTab("Root.Orders", new TextField("RestaurantConfirmedEmailSubject"));
        $fields->addFieldToTab("Root.Orders", new HTMLEditorField("RestaurantConfirmedEmailBody"));
        $fields->addFieldToTab("Root.Orders", new TextField("ReadyToPickUpEmailSubject"));
        $fields->addFieldToTab("Root.Orders", new HTMLEditorField("ReadyToPickUpEmailBody"));
    }
}
