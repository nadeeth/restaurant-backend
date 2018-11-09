<?php

namespace MyProject\GraphQL;

use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\TypeCreator;
use SilverStripe\GraphQL\Pagination\Connection;

class PageTypeCreator extends TypeCreator
{
    public function attributes()
    {
        return [
            'name' => 'page'
        ];
    }

    public function fields()
    {
        return [
            'ID' => ['type' => Type::nonNull(Type::id())],
            'Title' => ['type' => Type::string()],
            'URLSegment' => ['type' => Type::string()],
        ];
    }
}
