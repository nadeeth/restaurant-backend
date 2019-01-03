<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\GraphQL\OperationResolver;
use SilverStripe\GraphQL\QueryCreator;

class ReadSiteConfigQueryCreator extends QueryCreator implements OperationResolver
{
    public function attributes()
    {
        return [
            'name' => 'readSiteConfig'
        ];
    }

    public function args()
    {
        return [];
    }

    public function type()
    {
        return Type::listOf($this->manager->getType('siteConfig'));
    }

    public function resolve($object, array $args, $context, ResolveInfo $info)
    {
        return SiteConfig::current_site_config(); ;
    }
}
