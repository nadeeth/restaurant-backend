<?php

use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Control\Director;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\CMS\Model\SiteTree;

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
        'appMenu'
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

    public function appMenu(HTTPRequest $request) {
        $pages = SiteTree::get()->filter([
            'ParentID' => 0
        ]);
        $data = [];
        foreach ($pages as $page) {
            if ($page->ShowInMenus) {
                $row = ['ID'=>$page->ID, 'MenuTitle'=>$page->MenuTitle, 'URL'=>$page->URLSegment];
                foreach ($page->Children() as $child) {
                    if ($child->ShowInMenus) {
                        $row['Children'][] = 
                            ['ID'=>$child->ID, 'MenuTitle'=>$child->MenuTitle, 'URL'=>$page->URLSegment.'/'.$child->URLSegment];
                    }
                }
                $data[] = $row;
            }
        }
        return json_encode($data);
    }
}
