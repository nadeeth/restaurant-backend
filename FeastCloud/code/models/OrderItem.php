<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Control\Email\Email;
use SilverStripe\CMS\Model\SiteTree;

class OrderItem extends DataObject
{
    private static $table_name = 'OrderItem';

    private static $db = [
        'Title' => 'Varchar(150)',
        'Price' => 'Decimal',
        'Qty' => 'Int'
    ];

    private static $has_one = [
        'Order' => 'Order'
    ];
}
