<?php

use SilverStripe\Admin\ModelAdmin;

class EnquiryAdmin extends ModelAdmin 
{

    private static $managed_models = [
        'Enquiry'
    ];

    private static $url_segment = 'enquiries';

    private static $menu_title = 'Enquiries';
}