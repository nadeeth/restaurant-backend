<?php

namespace FeastCloud\GraphQL;

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
            'MenuTitle' => ['type' => Type::string()],
            'Title' => ['type' => Type::string()],
            'URLSegment' => ['type' => Type::string()],
            'Content' => ['type' => Type::string()],
            'ShowInMenus' => ['type' => Type::boolean()],
            'ClassName' => ['type' => Type::string()],
            'Banner' => ['type' => $this->manager->getType('image')],
            'ShowInFooterMenu' => ['type' => Type::boolean()]
        ];
    }
}
