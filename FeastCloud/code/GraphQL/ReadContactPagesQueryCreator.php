<?php

namespace FeastCloud\GraphQL;

use FeastCloud\GraphQL\ReadPagesQueryCreator;
use GraphQL\Type\Definition\Type;

class ReadContactPagesQueryCreator extends ReadPagesQueryCreator
{
    public function attributes()
    {
        return [
            'name' => 'readContactPages'
        ];
    }

    public function type()
    {
        return Type::listOf($this->manager->getType('contactPage'));
    }
}
