<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\Type;
use FeastCloud\GraphQL\PageTypeCreator;

class ContactPageTypeCreator extends PageTypeCreator
{
    public function attributes()
    {
        return [
            'name' => 'contactpage'
        ];
    }

    public function fields()
    {
        $fields = parent::fields();

        $fields['To'] = ['type' => Type::string()];
        
        return $fields;
    }
}
