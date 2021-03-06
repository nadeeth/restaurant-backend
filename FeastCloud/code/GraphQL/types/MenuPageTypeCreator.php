<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\Type;
use FeastCloud\GraphQL\PageTypeCreator;
use SilverStripe\GraphQL\Pagination\Connection;

class MenuPageTypeCreator extends PageTypeCreator
{
    public function attributes()
    {
        return [
            'name' => 'menupage'
        ];
    }

    public function fields()
    {
        $fields = parent::fields();

        $menuItemsConnection = Connection::create('MenuItems')
            ->setConnectionType(function () {
                return $this->manager->getType('menuItem');
            })
            ->setDescription('A list of the menu items')
            ->setSortableFields(['ID', 'Title']);

        $fields['MenuItems'] = [
            'type' => $menuItemsConnection->toType(),
            'args' => $menuItemsConnection->args(),
            'resolve' => function($obj, $args, $context) use ($menuItemsConnection) {
                return $menuItemsConnection->resolveList(
                    $obj->MenuItems(),
                    $args,
                    $context
                );
            }
        ];

        return $fields;
    }
}
