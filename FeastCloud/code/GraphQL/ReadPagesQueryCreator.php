<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\GraphQL\OperationResolver;
use SilverStripe\GraphQL\QueryCreator;

class ReadPagesQueryCreator extends QueryCreator implements OperationResolver
{
    public function attributes()
    {
        return [
            'name' => 'readPages'
        ];
    }

    public function args()
    {
        return [
            'URLSegment' => ['type' => Type::string()],
            'ShowInMenus' => ['type' => Type::boolean()],
        ];
    }

    public function type()
    {
        return Type::listOf($this->manager->getType('page'));
    }

    public function resolve($object, array $args, $context, ResolveInfo $info)
    {
        $filters = [];

        if (isset($args['ShowInMenus'])) {
            $filters['ShowInMenus'] = $args['ShowInMenus'];
        }
        if (isset($args['URLSegment'])) {
            $filters['URLSegment'] = $args['URLSegment'];
        }

        $list = $filters ? SiteTree::get()->filter($filters) : SiteTree::get();

        return $list;
    }
}
