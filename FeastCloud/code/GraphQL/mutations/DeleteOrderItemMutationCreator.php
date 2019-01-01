<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\MutationCreator;
use SilverStripe\GraphQL\OperationResolver;

class DeleteOrderItemMutationCreator extends MutationCreator implements OperationResolver
{
    public function attributes()
    {
        return [
            'name' => 'deleteOrderItem',
            'description' => 'Delete an order item'
        ];
    }

    public function type()
    {
        return $this->manager->getType('orderItem');
    }

    public function args()
    {
        return [
            'ID' => ['type' => Type::int()]
        ];
    }

    public function resolve($object, array $args, $context, ResolveInfo $info)
    {
        $orderItem =  \OrderItem::get()->byId($args['ID']);
        $orderItem->delete();
        return $orderItem;
    }
}
