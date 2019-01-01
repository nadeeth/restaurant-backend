<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Control\Email\Email;
use SilverStripe\CMS\Model\SiteTree;

class Order extends DataObject
{
    private static $table_name = 'Order';

    public static $order_statuses = [
        'Created',
        'CustomerConfirmed',
        'RestaurantConfirmed',
        'ReadyToCollect',
        'Collected'
    ];

    private static $db = [
        'Name' => 'Varchar(80)',
        'Email' => 'Varchar(50)',
        'Phone' => 'Varchar(20)',
        'PickUpTime' => 'Int',
        'Message' => 'Text',
        'Status' => 'Varchar(20)'
    ];

    private static $has_many = [
        'OrderItems' => 'OrderItem'
    ];

    public function onBeforeWrite()
    {
        // TODO : Send emails on order status change
        // $subject = 'An enquiry from ' . $this->Name;
        // $contactPage = SiteTree::get()->filter(['URLSegment'=>'contact-us'])->first();
        // $email = new Email($this->Email, $contactPage->To, $subject, $this->Message);
        // $email->sendPlain();

        parent::onBeforeWrite();
    }
}
