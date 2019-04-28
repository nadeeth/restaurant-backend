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
        'FooterText' => 'Varchar(200)',
        'Facebook' => 'Varchar(150)',
        'Twitter' => 'Varchar(150)',
        'Instagram' => 'Varchar(200)',
        'YouTube' => 'Varchar(200)',
    ];

    private static $has_one = [
        'Logo' => Image::class
    ];

    public function updateCMSFields(FieldList $fields) 
    {
        $fields->addFieldToTab('Root.Main', UploadField::create('Logo'));
        $fields->addFieldToTab('Root.Main', new TextField('FooterText'));

        $fields->addFieldToTab('Root.SocialMedia', new TextField('Facebook'));
        $fields->addFieldToTab('Root.SocialMedia', new TextField('Twitter'));
        $fields->addFieldToTab('Root.SocialMedia', new TextField('Instagram'));
        $fields->addFieldToTab('Root.SocialMedia', new TextField('YouTube'));

        $fields->addFieldToTab("Root.OrderSettings", new TextField("SendOrdersTo"));
        $fields->addFieldToTab("Root.OrderSettings", new TextField("OrderTax"));
        $fields->addFieldToTab("Root.OrderSettings", new TextField("OrderDiscount"));
        $fields->addFieldToTab("Root.OrderSettings", new TextField("RestaurantConfirmedEmailSubject"));
        $fields->addFieldToTab("Root.OrderSettings", new HTMLEditorField("RestaurantConfirmedEmailBody"));
        $fields->addFieldToTab("Root.OrderSettings", new TextField("ReadyToPickUpEmailSubject"));
        $fields->addFieldToTab("Root.OrderSettings", new HTMLEditorField("ReadyToPickUpEmailBody"));
    }
}
