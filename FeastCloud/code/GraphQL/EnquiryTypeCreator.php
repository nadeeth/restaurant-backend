<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\TypeCreator;
use SilverStripe\GraphQL\Pagination\Connection;

class EnquiryTypeCreator extends TypeCreator
{
    public function attributes()
    {
        return [
            'name' => 'enquiry'
        ];
    }

    public function fields()
    {
        return [
            'ID' => ['type' => Type::nonNull(Type::id())],
            'Name' => ['type' => Type::string()],
            'Email' => ['type' => Type::string()],
            'Phone' => ['type' => Type::string()],
            'Message' => ['type' => Type::string()]
        ];
    }
}
