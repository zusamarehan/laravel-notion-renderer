<?php

namespace RehanKanak\LaravelNotionRenderer\Blocks;

use RehanKanak\LaravelNotionRenderer\Renderers\NotionRenderer;

class Block
{
    public $block;

    public $previousBlock;

    public $result;

    public function __construct($block, $previousBlock)
    {
        $this->block = $block;
        $this->previousBlock = $previousBlock;
        $this->result = '';

        if (in_array($block['type'], NotionRenderer::BLOCKS_WITHOUT_LIST) && ($this->previousBlock && $this->previousBlock['type'] === 'numbered_list_item')) {
            $this->result .= NumberedList::end();
        }

        if (in_array($block['type'], NotionRenderer::BLOCKS_WITHOUT_LIST) && ($this->previousBlock && $this->previousBlock['type'] === 'bulleted_list_item')) {
            $this->result .= BulletList::end();
        }

        if ($block['type'] === 'numbered_list_item' && ($this->previousBlock && $this->previousBlock['type'] !== 'numbered_list_item')) {
            if ($this->previousBlock['type'] === 'bulleted_list_item') {
                $this->result .= BulletList::end();
            }

            $this->result .= NumberedList::start();
        }

        if ($block['type'] === 'bulleted_list_item' && ($this->previousBlock && $this->previousBlock['type'] !== 'bulleted_list_item')) {
            if ($this->previousBlock['type'] === 'numbered_list_item') {
                $this->result .= NumberedList::end();
            }

            $this->result .= BulletList::start();
        }
    }
}
