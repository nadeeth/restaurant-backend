<?php

namespace FeastCloud\GraphQL;

use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use SilverStripe\GraphQL\MutationCreator;
use SilverStripe\GraphQL\OperationResolver;

class CreateEnquiryMutationCreator extends MutationCreator implements OperationResolver
{
    public function attributes()
    {
        return [
            'name' => 'createEnquiry',
            'description' => 'Creates an enquiry'
        ];
    }

    public function type()
    {
        return $this->manager->getType('enquiry');
    }

    public function args()
    {
        return [
            'Email' => ['type' => Type::nonNull(Type::string())],
            'Name' => ['type' => Type::string()],
            'Phone' => ['type' => Type::string()],
            'Message' => ['type' => Type::string()]
        ];
    }

    public function resolve($object, array $args, $context, ResolveInfo $info)
    {
        $enquiry = \Enquiry::create();
        $enquiry->Email = $args['Email'];
        $enquiry->Name = $args['Name'];
        $enquiry->Phone = $args['Phone'];
        $enquiry->Message = $args['Message'];
        $enquiry->write();
        return $enquiry;
    }
}
