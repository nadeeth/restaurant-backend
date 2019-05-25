<?php

use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;

class MenuPage extends Page
{
    private static $db = [];

    private static $has_many = [
        'MenuItems' => 'MenuItem'
    ];

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $config = GridFieldConfig_RecordEditor::create();
        $fields->addFieldToTab('Root.MenuItems',
            new GridField('MenuItems', 'Menu Items', $this->MenuItems(), $config)
        );

        $fields->addFieldToTab('Root.Categories', GridField::create(
            'Category',
            'Category',
            MenuItemCategory::get(),
            GridFieldConfig_RecordEditor::create()
        ));

        return $fields;
    }
}
