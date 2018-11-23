<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\ResolveInfo;
use FeastCloud\GraphQL\ReadPagesQueryCreator;
use GraphQL\Type\Definition\Type;

class ReadMenuPagesQueryCreator extends ReadPagesQueryCreator
{
    public function attributes()
    {
        return [
            'name' => 'readMenuPages'
        ];
    }

    public function type()
    {
        return Type::listOf($this->manager->getType('menuPage'));
    }
}
