<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\MutationCreator;
use SilverStripe\GraphQL\OperationResolver;

class CreateOrderItemMutationCreator extends MutationCreator implements OperationResolver
{
    public function attributes()
    {
        return [
            'name' => 'createOrderItem',
            'description' => 'Creates an order item'
        ];
    }

    public function type()
    {
        return $this->manager->getType('orderItem');
    }

    public function args()
    {
        return [
            'ID' => ['type' => Type::int()],
            'OrderID' => ['type' => Type::int()],
            'Title' => ['type' => Type::string()],
            'Price' => ['type' => Type::float()],
            'Qty' => ['type' => Type::int()]
        ];
    }

    public function resolve($object, array $args, $context, ResolveInfo $info)
    {
        $orderItem = (isset($args['ID']) && $args['ID']) ? \OrderItem::get()->byId($args['ID']) : \OrderItem::create();
        $orderItem->Title = $args['Title'];
        $orderItem->Price = $args['Price'];
        $orderItem->Qty = $args['Qty'];
        $orderItem->OrderID = $args['OrderID'];
        $orderItem->write();
        return $orderItem;
    }
}
