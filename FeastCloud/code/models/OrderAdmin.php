<?php

use SilverStripe\Admin\ModelAdmin;

class OrderAdmin extends ModelAdmin 
{

    private static $managed_models = [
        'Order'
    ];

    private static $url_segment = 'orders';

    private static $menu_title = 'Orders';
}