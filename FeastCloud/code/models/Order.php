<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Control\Email\Email;
use SilverStripe\CMS\Model\SiteTree;

class Order extends DataObject
{
    private static $table_name = 'Order';

    private static $db = [
        'Name' => 'Varchar(80)',
        'Email' => 'Varchar(50)',
        'Phone' => 'Varchar(20)',
        'PickUpTime' => 'Int',
        'Message' => 'Text'
    ];

    private static $has_many = [
        'OrderItems' => 'OrderItem'
    ];
}
