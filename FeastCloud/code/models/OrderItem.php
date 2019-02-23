<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Control\Email\Email;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Security\Permission;

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

    private static $summary_fields = [
        'Title',
        'Price',
        'Qty'
    ];

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        //TODO: hide order field 
        return $fields;
    }

    public function canView($member = null) {
        return Permission::check('CMS_ACCESS_OrderAdmin', 'any', $member);
    }

    public function canEdit($member = null) {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canDelete($member = null) {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canCreate($member = null, $context = []) {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }
}
