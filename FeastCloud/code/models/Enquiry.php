<?php

use SilverStripe\ORM\DataObject;
use SilverStripe\Control\Email\Email;
use SilverStripe\CMS\Model\SiteTree;

class Enquiry extends DataObject
{
    private static $table_name = 'Enquiry';

    private static $db = [
        'Name' => 'Varchar(80)',
        'Email' => 'Varchar(50)',
        'Phone' => 'Varchar(20)',
        'Message' => 'Text'
    ];

    public function onBeforeWrite()
    {
        $subject = 'An enquiry from ' . $this->Name;
        $contactPage = SiteTree::get()->filter(['URLSegment'=>'contact-us'])->first();
        $email = new Email($this->Email, $contactPage->To, $subject, $this->Message);
        $email->sendPlain();

        parent::onBeforeWrite();
    }
}
