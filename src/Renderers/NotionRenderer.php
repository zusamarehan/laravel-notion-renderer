<?php

namespace RehanKanak\LaravelNotionRenderer\Renderers;

use RehanKanak\LaravelNotionRenderer\Blocks\Callout;
use RehanKanak\LaravelNotionRenderer\Blocks\Divider;
use RehanKanak\LaravelNotionRenderer\Blocks\Heading1;
use RehanKanak\LaravelNotionRenderer\Blocks\Heading2;
use RehanKanak\LaravelNotionRenderer\Blocks\Heading3;
use RehanKanak\LaravelNotionRenderer\Blocks\Image;
use RehanKanak\LaravelNotionRenderer\Blocks\Listing;
use RehanKanak\LaravelNotionRenderer\Blocks\Paragraph;
use RehanKanak\LaravelNotionRenderer\Blocks\Quote;
use RehanKanak\LaravelNotionRenderer\Blocks\Table;
use RehanKanak\LaravelNotionRenderer\Exceptions\NotionException;
use RehanKanak\LaravelNotionRenderer\NotionAPIService\NotionBlocks;

class NotionRenderer
{
    public $blocks = [];

    public $previousBlock;

    public $results;

    const BLOCKS = [
        'paragraph',
        'heading_1',
        'heading_2',
        'heading_3',
        'numbered_list_item',
        'bulleted_list_item',
        'callout',
        'quote',
        'image',
        'table',
        'divider',
    ];

    const BLOCKS_WITHOUT_LIST = [
        'paragraph',
        'heading_1',
        'heading_2',
        'heading_3',
        'callout',
        'quote',
        'image',
        'table',
    ];

    /**
     * @throws NotionException
     */
    public function __construct($pageId)
    {
        $response = (new NotionBlocks())->fetch($pageId);

        if (! $response['success']) {
            throw new NotionException($response['details']['message'], $response['details']['status']);
        }

        $this->blocks = $response['data'];
        $this->render();
    }

    /**
     * @throws NotionException
     */
    public function render(): NotionRenderer
    {
        foreach ($this->blocks as $block) {
            if (! in_array($block['type'], NotionRenderer::BLOCKS)) {
                continue;
            }

            if ($block['type'] === 'paragraph') {
                $this->results .= (new Paragraph($block, $this->previousBlock))
                    ->process()
                    ->render();
            }

            if ($block['type'] === 'heading_1') {
                $this->results .= (new Heading1($block, $this->previousBlock))
                    ->process()
                    ->render();
            }

            if ($block['type'] === 'heading_2') {
                $this->results .= (new Heading2($block, $this->previousBlock))
                    ->process()
                    ->render();
            }

            if ($block['type'] === 'heading_3') {
                $this->results .= (new Heading3($block, $this->previousBlock))
                    ->process()
                    ->render();
            }

            if ($block['type'] === 'callout') {
                $this->results .= (new Callout($block, $this->previousBlock))
                    ->process()
                    ->render();
            }

            if ($block['type'] === 'quote') {
                $this->results .= (new Quote($block, $this->previousBlock))
                    ->process()
                    ->render();
            }

            if ($block['type'] === 'numbered_list_item') {
                $this->results .= (new Listing($block, $this->previousBlock))
                    ->process()
                    ->render();
            }

            if ($block['type'] === 'bulleted_list_item') {
                $this->results .= (new Listing($block, $this->previousBlock))
                    ->process()
                    ->render();
            }

            if ($block['type'] === 'image') {
                $this->results .= (new Image($block, $this->previousBlock))
                    ->caption()
                    ->process()
                    ->render();
            }

            if ($block['type'] === 'table') {
                $this->results .= (new Table($block, $this->previousBlock))
                    ->children()
                    ->process()
                    ->render();
            }

            if ($block['type'] === 'divider') {
                $this->results .= (new Divider($block, $this->previousBlock))
                    ->process()
                    ->render();
            }

            $this->previousBlock = $block;
        }

        return $this;
    }

    public function html()
    {
        return $this->results;
    }
}
