<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Control\Email\Email;
use SilverStripe\CMS\Model\SiteTree;
use Silverstripe\SiteConfig\SiteConfig;
use SilverStripe\Forms\DropdownField;

class Order extends DataObject
{
    private static $table_name = 'Order';

    public static $order_statuses = [
        'Created',
        'CustomerConfirmed',
        'RestaurantConfirmed',
        'Ready',
        'Collected'
    ];

    private static $db = [
        'Name' => 'Varchar(80)',
        'Email' => 'Varchar(50)',
        'Phone' => 'Varchar(20)',
        'PickUpTime' => 'Int',
        'Message' => 'Text',
        'Status' => 'Varchar(20)',
        'Total' => 'Decimal',
        'Tax' => 'Decimal',
        'Discount' => 'Decimal',
        'NetTotal' => 'Decimal'
    ];

    private static $has_many = [
        'OrderItems' => 'OrderItem'
    ];

    public function onBeforeWrite()
    {
        $config = SiteConfig::current_site_config(); 

        // TODO : Send emails on order status change
        // $subject = 'An enquiry from ' . $this->Name;
        // $contactPage = SiteTree::get()->filter(['URLSegment'=>'contact-us'])->first();
        // $email = new Email($this->Email, $contactPage->To, $subject, $this->Message);
        // $email->sendPlain();

        // Do this whole thing in the Front End - Calculate order total, including service charges, discounts etc. 
        /*
        if (!$this->ID) {
            $this->Tax = $config->OrderTax;
            $this->Discount = $config->OrderDiscount;
        }
        if ($this->ID) {
            $items = \OrderItem::get()->filter(['OrderID' => $this->ID]);
            $this->Total = 0;
            
            foreach ($items as $item) {
                $this->Total += $item->Price;
            }
            if ($this->Total) {
                $taxAmount = ($this->Total / 100) * $this->Tax;
                $discountAmount = ($this->Total / 100) * $this->Discount;
                $this->NetTotal = $this->Total + $this->Tax - $this->Discount;
            }
        }
        */

        parent::onBeforeWrite();
    }

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        //TODO: make some fields readonly 
        $fields->addFieldToTab('Root.Main', DropdownField::create('Status', 'Status', Order::$order_statuses), 'Name');

        return $fields;
    }
}
