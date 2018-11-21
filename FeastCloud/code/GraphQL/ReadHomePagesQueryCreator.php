<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\ResolveInfo;
use FeastCloud\GraphQL\ReadPagesQueryCreator;
use GraphQL\Type\Definition\Type;

class ReadHomePagesQueryCreator extends ReadPagesQueryCreator
{
    public function attributes()
    {
        return [
            'name' => 'readHomePages'
        ];
    }

    public function type()
    {
        return Type::listOf($this->manager->getType('homePage'));
    }

    public function resolve($object, array $args, $context, ResolveInfo $info)
    {
        $list = parent::resolve($object, $args, $context, $info);
        foreach ($list as &$item) {
            $item->Background = 'kk';//$item->Background->URL;
        }
        return $list;
    }
}
