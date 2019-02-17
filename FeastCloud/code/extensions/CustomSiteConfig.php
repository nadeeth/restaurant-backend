<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\ORM\DataExtension;

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

    public function updateCMSFields(FieldList $fields) 
    {
        $fields->addFieldToTab("Root.Orders", new TextField("SendOrdersTo"));
        $fields->addFieldToTab("Root.Orders", new TextField("OrderTax"));
        $fields->addFieldToTab("Root.Orders", new TextField("OrderDiscount"));
        $fields->addFieldToTab("Root.Orders", new TextField("RestaurantConfirmedEmailSubject"));
        $fields->addFieldToTab("Root.Orders", new HTMLEditorField("RestaurantConfirmedEmailBody"));
        $fields->addFieldToTab("Root.Orders", new TextField("ReadyToPickUpEmailSubject"));
        $fields->addFieldToTab("Root.Orders", new HTMLEditorField("ReadyToPickUpEmailBody"));
    }
}
