<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\Type;
use FeastCloud\GraphQL\PageTypeCreator;

class HomePageTypeCreator extends PageTypeCreator
{
    public function attributes()
    {
        return [
            'name' => 'homepage'
        ];
    }

    public function fields()
    {
        $fields = parent::fields();

        $fields['Background'] = [
            'type' => Type::string()
        ];

        return $fields;
    }
}
