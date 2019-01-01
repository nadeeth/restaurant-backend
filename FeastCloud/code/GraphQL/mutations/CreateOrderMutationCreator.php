<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\MutationCreator;
use SilverStripe\GraphQL\OperationResolver;

class CreateOrderMutationCreator extends MutationCreator implements OperationResolver
{
    public function attributes()
    {
        return [
            'name' => 'createOrder',
            'description' => 'Creates an order'
        ];
    }

    public function type()
    {
        return $this->manager->getType('order');
    }

    public function args()
    {
        return [
            'ID' => ['type' => Type::int()],
            'Email' => ['type' => Type::string()],
            'Name' => ['type' => Type::string()],
            'Phone' => ['type' => Type::nonNull(Type::string())],
            'PickUpTime' => ['type' => Type::int()],
            'Message' => ['type' => Type::string()],
            'Status' => ['type' => Type::string()]
        ];
    }

    public function resolve($object, array $args, $context, ResolveInfo $info)
    {
        $order = (isset($args['ID']) && $args['ID']) ? \Order::get()->byId($args['ID']) : \Order::create();
        $order->Email = $args['Email'];
        $order->Name = $args['Name'];
        $order->Phone = $args['Phone'];
        $order->PickUpTime = $args['PickUpTime'];
        $order->Message = $args['Message'];
        $order->Status = $args['Status'];
        $order->write();
        return $order;
    }
}
