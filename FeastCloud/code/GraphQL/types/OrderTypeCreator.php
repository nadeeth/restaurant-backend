<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\TypeCreator;
use SilverStripe\GraphQL\Pagination\Connection;

class OrderTypeCreator extends TypeCreator
{
    public function attributes()
    {
        return [
            'name' => 'order'
        ];
    }

    public function fields()
    {
        $orderItemsConnection = Connection::create('OrderItems')
            ->setConnectionType(function () {
                return $this->manager->getType('orderItem');
            })
            ->setDescription('A list of the order items')
            ->setSortableFields(['ID', 'Title']);

        return [
            'ID' => ['type' => Type::nonNull(Type::id())],
            'Name' => ['type' => Type::string()],
            'Email' => ['type' => Type::string()],
            'Phone' => ['type' => Type::string()],
            'PickUpTime' => ['type' => Type::int()],
            'Message' => ['type' => Type::string()],
            'Status' => ['type' => Type::string()],
            'Total' => ['type' => Type::float()],
            'Tax' => ['type' => Type::float()],
            'Discount' => ['type' => Type::float()],
            'NetTotal' => ['type' => Type::float()],
            'OrderItems' => [
                'type' => $orderItemsConnection->toType(),
                'args' => $orderItemsConnection->args(),
                'resolve' => function($obj, $args, $context) use ($orderItemsConnection) {
                    return $orderItemsConnection->resolveList(
                        $obj->OrderItems(),
                        $args,
                        $context
                    );
                }
            ]
        ];
    }
}
