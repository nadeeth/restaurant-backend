<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\OperationResolver;
use SilverStripe\GraphQL\QueryCreator;

class ReadOrdersQueryCreator extends QueryCreator implements OperationResolver
{
    public function attributes()
    {
        return [
            'name' => 'readOrders'
        ];
    }

    public function args()
    {
        return [
            'ID' => ['type' => Type::int()],
            'Name' => ['type' => Type::string()],
            'Email' => ['type' => Type::string()],
            'Phone' => ['type' => Type::string()],
        ];
    }

    public function type()
    {
        return Type::listOf($this->manager->getType('order'));
    }

    public function resolve($object, array $args, $context, ResolveInfo $info)
    {
        $order = \Order::singleton();
        if (!$order->canView($context['currentUser'])) {
            throw new \InvalidArgumentException(sprintf(
                '%s view access not permitted',
                Order::class
            ));
        }
        
        $filters = [];

        if (isset($args['ID'])) {
            $filters['ID'] = $args['ID'];
        }
        if (isset($args['Name'])) {
            $filters['Name'] = $args['Name'];
        }
        if (isset($args['Email'])) {
            $filters['Email'] = $args['Email'];
        }
        if (isset($args['Phone'])) {
            $filters['Phone'] = $args['Phone'];
        }

        $list = $filters ? \Order::get()->filter($filters) : \Order::get();

        return $list;
    }
}
