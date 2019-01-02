<?php

use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\DataExtension;

class CustomSiteConfig extends DataExtension 
{

    private static $db = [
        'SendOrdersTo' => 'Varchar(50)',
        'OrderTax' => 'Decimal',
        'OrderDiscout' => 'Decimal',
        'CustomerConfirmedEmailSubject' => 'Varchar(100)',
        'CustomerConfirmedEmailBody' => 'Text',
        'RestaurantConfirmedEmailSubject' => 'Varchar(100)',
        'RestaurantConfirmedEmailBody' => 'Text',
        'ReadyToPickUpEmailSubject' => 'Varchar(100)',
        'ReadyToPickUpEmailBody' => 'Text',
    ];

    public function updateCMSFields(FieldList $fields) 
    {
        $fields->addFieldToTab("Root.Orders", new TextField("SendOrdersTo"));
        $fields->addFieldToTab("Root.Orders", new TextField("OrderTax"));
        $fields->addFieldToTab("Root.Orders", new TextField("OrderDiscout"));
        $fields->addFieldToTab("Root.Orders", new TextField("CustomerConfirmedEmailSubject"));
        $fields->addFieldToTab("Root.Orders", new TextareaField("CustomerConfirmedEmailBody"));
        $fields->addFieldToTab("Root.Orders", new TextField("RestaurantConfirmedEmailSubject"));
        $fields->addFieldToTab("Root.Orders", new TextareaField("RestaurantConfirmedEmailBody"));
        $fields->addFieldToTab("Root.Orders", new TextField("ReadyToPickUpEmailSubject"));
        $fields->addFieldToTab("Root.Orders", new TextareaField("ReadyToPickUpEmailBody"));
    }
}
