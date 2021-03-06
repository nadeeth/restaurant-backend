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
}
