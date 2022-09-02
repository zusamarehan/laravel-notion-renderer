<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Notion API Key
    |--------------------------------------------------------------------------
    |
    | This value is the API key for your Notion account.
    | You can find your API key here: https://www.notion.so/my-integrations
    | Please load this though .env file.
    */
    'NOTION_API' => env('NOTION_API'),

    /*
    |--------------------------------------------------------------------------
    | Notion API Version
    |--------------------------------------------------------------------------
    |
    | This value allows you to set the Notion API version to be used
    | while making the API calls. You can find more details on versioning
    | of Notion here: https://developers.notion.com/reference/versioning
    */
    'NOTION_API_VERSION' => env('NOTION_API_VERSION', '2022-02-22'),
];
