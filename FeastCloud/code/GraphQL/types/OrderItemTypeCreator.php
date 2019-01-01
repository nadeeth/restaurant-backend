<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\TypeCreator;
use SilverStripe\GraphQL\Pagination\Connection;

class OrderItemTypeCreator extends TypeCreator
{
    public function attributes()
    {
        return [
            'name' => 'orderItem'
        ];
    }

    public function fields()
    {
        return [
            'ID' => ['type' => Type::nonNull(Type::id())],
            'Title' => ['type' => Type::string()],
            'Price' => ['type' => Type::float()],
            'Qty' => ['type' => Type::int()]
        ];
    }
}
