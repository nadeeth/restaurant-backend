<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\TypeCreator;
use SilverStripe\GraphQL\Pagination\Connection;

class ImageTypeCreator extends TypeCreator
{
    public function attributes()
    {
        return [
            'name' => 'image'
        ];
    }

    public function fields()
    {
        return [
            'ID' => ['type' => Type::nonNull(Type::id())],
            'Title' => ['type' => Type::string()],
            'Name' => ['type' => Type::string()],
            'Filename' => ['type' => Type::string()],
            'File' => ['type' => Type::string()],
            'URL' => ['type' => Type::string()],
        ];
    }
}
