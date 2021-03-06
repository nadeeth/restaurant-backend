<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\TypeCreator;
use SilverStripe\GraphQL\Pagination\Connection;

class SiteConfigTypeCreator extends TypeCreator
{
    public function attributes()
    {
        return [
            'name' => 'siteConfig'
        ];
    }

    public function fields()
    {
        return [
            'Title' => ['type' => Type::string()],
            'Tagline' => ['type' => Type::string()],
            'Logo' => ['type' => $this->manager->getType('image')],
            'FooterText' => ['type' => Type::string()],
            'OpenTime' => ['type' => Type::string()],
            'CloseTime' => ['type' => Type::string()],
            'Facebook' => ['type' => Type::string()],
            'Twitter' => ['type' => Type::string()],
            'Instagram' => ['type' => Type::string()],
            'YouTube' => ['type' => Type::string()],
            'OrderTax' => ['type' => Type::float()],
            'OrderDiscount' => ['type' => Type::float()]
        ];
    }
}
