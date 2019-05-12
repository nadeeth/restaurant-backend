<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Control\Email\Email;
use SilverStripe\CMS\Model\SiteTree;
use Silverstripe\SiteConfig\SiteConfig;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\ReadonlyField;
use SilverStripe\Security\Permission;
use SilverStripe\Security\Member;

class Order extends DataObject
{
    private static $table_name = 'Order';

    public static $order_statuses = [
        'Created' => 'Created',
        'CustomerConfirmed' => 'CustomerConfirmed',
        'RestaurantConfirmed' => 'RestaurantConfirmed',
        'Ready' => 'Ready',
        'Collected' => 'Collected'
    ];

    private static $db = [
        'Name' => 'Varchar(80)',
        'Email' => 'Varchar(50)',
        'Phone' => 'Varchar(20)',
        'PickUpTime' => 'Varchar(32)',
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

    private static $summary_fields = [
        'Name',
        'Status',
        'PickUpTime'
    ];

    private static $default_sort = 'Created DESC';

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $status = DropdownField::create('Status', 'Status', Order::$order_statuses);
        $fields->addFieldToTab('Root.Main', $status, 'Name');

        if (!Permission::check('CMS_ACCESS_CMSMain', 'any', Member::currentUser())) {
            $fields->addFieldToTab('Root.Main', ReadonlyField::create('Name', 'Name'));
            $fields->addFieldToTab('Root.Main', ReadonlyField::create('Email', 'Email'));
            $fields->addFieldToTab('Root.Main', ReadonlyField::create('Phone', 'Phone'));
            $fields->addFieldToTab('Root.Main', ReadonlyField::create('PickUpTime', 'PickUpTime'));
            $fields->addFieldToTab('Root.Main', ReadonlyField::create('Message', 'Message'));
            $fields->addFieldToTab('Root.Main', ReadonlyField::create('Total', 'Total'));
            $fields->addFieldToTab('Root.Main', ReadonlyField::create('Tax', 'Tax'));
            $fields->addFieldToTab('Root.Main', ReadonlyField::create('Discount', 'Discount'));
            $fields->addFieldToTab('Root.Main', ReadonlyField::create('NetTotal', 'NetTotal'));
        }

        return $fields;
    }

    private function sendOrderEmail() {

        $config = SiteConfig::current_site_config(); 

        $this->sendEmail('CustomerConfirmed',
            'Order from ' . $this->Name, 
            [
                'Name' => $this->Name,
                'Email' => $this->Email,
                'Phone' => $this->Phone,
                'PickUpTime' => $this->PickUpTime,
                'Message' => $this->Message,
                'Total' => $this->Total,
                'Tax' => $this->Tax,
                'Discount' => $this->Discount,
                'NetTotal' => $this->NetTotal,
                'OrderItems' => $this->OrderItems()
            ],
            $this->Email,
            $config->SendOrdersTo);
    }

    private function sendOrderConfirmation() {

        $config = SiteConfig::current_site_config();

        $email_body = str_replace(
            ['{Name}','{PickUpTime}'],
            [$this->Name, $this->PickUpTime],
            $config->RestaurantConfirmedEmailBody
        );

        $this->sendEmail('RestaurantConfirmed',
            $config->RestaurantConfirmedEmailSubject, ['EmailBody' => $email_body], $config->SendOrdersTo, $this->Email);
    }

    private function sendReadyToCollectEmail() {

        $config = SiteConfig::current_site_config();

        $email_body = str_replace(
            ['{Name}','{NetTotal}'],
            [$this->Name, $this->NetTotal],
            $config->ReadyToPickUpEmailBody
        );

        $this->sendEmail('ReadyToCollect',
            $config->ReadyToPickUpEmailSubject, ['EmailBody' => $email_body], $config->SendOrdersTo, $this->Email);
    }

    private function sendEmail($template, $subject, $data, $from, $to) {
        $email = Email::create()
                ->setHTMLTemplate('Email\\'.$template) 
                ->setData($data)
                ->setFrom($from)
                ->setTo($to)
                ->setSubject($subject);

        if ($email->send()) {
            // Do some logging
        } else {
            // Do some logging
        }
    }

    public function onBeforeWrite() {
        $config = SiteConfig::current_site_config();

        // Order received (CustomerConfirmed)
        if (($this->Status == 'CustomerConfirmed') && $config->SendOrdersTo) {
            $this->sendOrderEmail();            
        }

        // Order Confirmed by restaurant (RestaurantConfirmed)
        if ($this->Status == 'RestaurantConfirmed') {
            $this->sendOrderConfirmation();            
        }

        // Order ready to cllect
        if ($this->Status == 'Ready') {
            $this->sendReadyToCollectEmail();            
        }

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

    public function canView($member = null) {
        return Permission::check('CMS_ACCESS_OrderAdmin', 'any', $member);
    }

    public function canEdit($member = null) {
        return Permission::check('CMS_ACCESS_OrderAdmin', 'any', $member);
    }

    public function canDelete($member = null) {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canCreate($member = null, $context = []) {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }
}
