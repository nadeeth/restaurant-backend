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
            'URLSegment' => ['type' => Type::string()]
        ];
    }

    public function type()
    {
        return Type::listOf($this->manager->getType('page'));
    }

    public function resolve($object, array $args, $context, ResolveInfo $info)
    {
        if (isset($args['URLSegment'])) {
            $list = SiteTree::get()->filter([
                'URLSegment' => $args['URLSegment']
            ]);
        } else {
            $list = SiteTree::get();
        }

        return $list;
    }
}
