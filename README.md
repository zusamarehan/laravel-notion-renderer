## Generate HTML from Notion Page

This package converts all the blocks in a Notion page into HTML using Notion's API.
For more details on Notion API, please refer this page: https://developers.notion.com/

Currently, the Notion API returns the content in a form of JSON.
You can see example for JSON format here: https://codebeautify.org/jsonviewer/y222f395f for this page: https://tested-wheel-e55.notion.site/Example-Page-6927be844d994e51bdda5f0c903f6788

Our renderer converts the JSON and converts it into HTML (converting to Markdown is work in progress), which you can use to render in your web application.

---
## Installation

You can install the package via composer:

```bash
composer require rehan/laravel-notion-renderer
```
---
## Usage

```php
$pageHTML = (new NotionRenderer('yourPageId'))->html();
```

That's it 🎉

Your Notion Page is now converted to HTML and can use displayed in your web application.

Recommendation: We suggest to use https://tailwindcss.com/docs/typography-plugin to style the HTML (or you may use your own CSS for the styling).

Note: The NotionRenderer class extensively uses Notion's Block API (https://developers.notion.com/reference/get-block-children) to get
the content of the Notion Page. Also, your API key must be present at `.env` file, check the `config` file of the package for more details.

------
## Supported Block List:

Only the below blocks are currently Supported, but more blocks are coming soon.
- Paragraph
- Heading One
- Heading Two
- Heading Three
- Quote
- Numbered List
- Bulleted List
- Image
- Table
- Divider

Full list of blocks can be found here: https://developers.notion.com/reference/block

Note: Other blocks are under development

-----
## Service Classes (Optional to Use)

The package contains the following service classes:

### NotionBlocks
- To retrieve a Block object using the ID specified. (https://developers.notion.com/reference/get-block-children)
#### Usage
```php
$notionPageAsBlocks = (new NotionBlocks())->fetch('yourPageId')
```
### NotionDatabase
- To retrieve a list of Pages contained in the Notion database (https://developers.notion.com/reference/post-database-query)
#### Usage
```php
$notionDatabase = (new NotionDatabase())->fetch('yourDatabaseId')
```
### NotionPage
- To retrieve a Page object using the Notion ID specified. (https://developers.notion.com/reference/retrieve-a-page)
#### Usage
```php
$notionPage = (new NotionDatabase())->fetch('yourPageId')
```
---
### Note
For this to work, you need to create Integration and share the page with the Integration.
For more details on obtaining and creating Integrations, please refer this page: https://www.notion.so/my-integrations

## Credits

- [zusamarehan](https://github.com/zusamarehan)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
