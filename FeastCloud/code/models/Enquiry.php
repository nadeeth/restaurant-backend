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
        $contactPage = SiteTree::get()->filter(['URLSegment'=>'contact-us'])->first();

        $this->sendEmail('Enquiry',
            'An enquiry from ' . $this->Name, 
            [
                'Name' => $this->Name,
                'Email' => $this->Email,
                'Phone' => $this->Phone,
                'Message' => $this->Message
            ],
            $this->Email,
            $contactPage->To);

        parent::onBeforeWrite();
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
