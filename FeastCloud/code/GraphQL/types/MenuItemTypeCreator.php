<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\TypeCreator;
use SilverStripe\GraphQL\Pagination\Connection;

class MenuItemTypeCreator extends TypeCreator
{
    public function attributes()
    {
        return [
            'name' => 'menuItem'
        ];
    }

    public function fields()
    {
        return [
            'ID' => ['type' => Type::nonNull(Type::id())],
            'Title' => ['type' => Type::string()],
            'Description' => ['type' => Type::string()],
            'Price' => ['type' => Type::string()],
            'Image' => ['type' => $this->manager->getType('image')],
            'Category' => ['type' => $this->manager->getType('menuItemCategory')]
        ];
    }
}
