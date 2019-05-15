<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\MutationCreator;
use SilverStripe\GraphQL\OperationResolver;
use SilverStripe\Security\Permission;
use SilverStripe\Security\Member;

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
            'PickUpTime' => ['type' => Type::string()],
            'Message' => ['type' => Type::string()],
            'Status' => ['type' => Type::string()],
            'Total' => ['type' => Type::float()],
            'Tax' => ['type' => Type::float()],
            'Discount' => ['type' => Type::float()],
            'NetTotal' => ['type' => Type::float()],
            'OrderItems' => ['type' => Type::string()]
        ];
    }

    public function resolve($object, array $args, $context, ResolveInfo $info) {

        if (!Member::currentUser() || !Permission::check('CMS_ACCESS_OrderAdmin', 'any', Member::currentUser())) {
            $guest_actions = ['Created', 'CustomerConfirmed'];
            if(!in_array($args['Status'], $guest_actions)) {
                throw new \InvalidArgumentException(sprintf(
                    '%s create access not permitted',
                    Order::class
                ));
            }
        }

        $order = (isset($args['ID']) && $args['ID']) ? \Order::get()->byId($args['ID']) : \Order::create();
        $order->Email = $args['Email'];
        $order->Name = $args['Name'];
        $order->Phone = $args['Phone'];
        $order->PickUpTime = $args['PickUpTime'];
        $order->Message = $args['Message'];
        $order->Status = $args['Status'];
        $order->Total = $args['Total'];
        $order->Tax = $args['Tax'];
        $order->Discount = $args['Discount'];
        $order->NetTotal = $args['NetTotal'];
        $order->write();

        $orderItems = json_decode($args['OrderItems'], true);

        foreach($orderItems as $item) {
            if ($item['Title'] && $item['Price'] && $item['Qty']) {
                $orderItem = \OrderItem::create();
                $orderItem->Title = $item['Title'];
                $orderItem->Price = $item['Price'];
                $orderItem->Qty = $item['Qty'];
                $orderItem->OrderID = $order->ID;
                $orderItem->write();
            }
        }
        
        return $order;
    }
}
