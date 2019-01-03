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
            'OrderTax' => ['type' => Type::float()],
            'OrderDiscount' => ['type' => Type::float()]
        ];
    }
}
