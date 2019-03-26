<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Control\Email\Email;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Security\Permission;

class Enquiry extends DataObject
{
    private static $table_name = 'Enquiry';

    private static $db = [
        'Name' => 'Varchar(80)',
        'Email' => 'Varchar(50)',
        'Phone' => 'Varchar(20)',
        'Message' => 'Text'
    ];

    private static $summary_fields = [
        'Name',
        'Created'
    ];

    private static $default_sort = 'Created DESC';

    public function onBeforeWrite()
    {
        $subject = 'An enquiry from ' . $this->Name;
        $contactPage = SiteTree::get()->filter(['URLSegment'=>'contact-us'])->first();
        $email = new Email($this->Email, $contactPage->To, $subject, $this->Message);
        $email->sendPlain();

        parent::onBeforeWrite();
    }

    public function canView($member = null) {
        return Permission::check('CMS_ACCESS_EnquiryAdmin', 'any', $member);
    }

    public function canEdit($member = null) {
        return Permission::check('CMS_ACCESS_EnquiryAdmin', 'any', $member);
    }

    public function canDelete($member = null) {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canCreate($member = null, $context = []) {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }
}
