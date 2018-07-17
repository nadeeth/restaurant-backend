<?php

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;

class PageController extends ContentController
{
    /**
     * An array of actions that can be accessed via a request. Each array element should be an action name, and the
     * permissions or conditions required to allow the user to access it.
     *
     * <code>
     * [
     *     'action', // anyone can access this action
     *     'action' => true, // same as above
     *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
     *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
     * ];
     * </code>
     *
     * @var array
     */
    private static $allowed_actions = [
        'content'
    ];

    protected function init()
    {
        parent::init();
        // You can include any CSS or JS required by your project here.
        // See: https://docs.silverstripe.org/en/developer_guides/templates/requirements/
    }

    public function WebpackDevServer()
    {
        if(Director::isDev()) {
            return true;
            // $socket = @fsockopen('localhost', 3000, $errno, $errstr, 1);
            // return !$socket ? false : true;
        }
    }

    public function content(HTTPRequest $request) {
        $page = Page::get()->byID($this->ID);
        $data = [
            'Title' => $page->Title,
            'MenuTitle' => $page->MenuTitle,
            'URLSegment' => $page->URLSegment,
            'Content' => $page->Content,
        ];
        return json_encode($data);
    }
}
