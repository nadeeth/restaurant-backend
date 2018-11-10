<?php

namespace FeastCloud\GraphQL;

use Exception;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Security\Member;
use SilverStripe\Security\Permission;
use SilverStripe\GraphQL\Controller;

class FeastCloudController extends Controller
{
    /**
     * Get user and validate for this request
     *
     * @param HTTPRequest $request
     * @return Member
     */
    protected function getRequestUser(HTTPRequest $request)
    {
        // Check authentication
        $member = $this->getAuthHandler()->requireAuthentication($request);

        // Check authorisation
        $permissions = $request->param('Permissions');
        if (!$permissions) {
            return $member;
        }

        // If permissions requested require authentication
        // if (!$member) {
        //     throw new Exception("Authentication required");
        // }

        // Check authorisation for this member
        // $allowed = Permission::checkMember($member, $permissions);
        // if (!$allowed) {
        //     throw new Exception("Not authorised");
        // }
        
        return $member;
    }
}
