<?php

namespace RehanKanak\LaravelNotionRenderer\Blocks;

use RehanKanak\LaravelNotionRenderer\Exceptions\NotionException;
use RehanKanak\LaravelNotionRenderer\NotionAPIService\NotionBlocks;

class Table extends Block
{
    public $children;

    private function start(): void
    {
        $this->result .= '<table>';
    }

    private function end(): void
    {
        $this->result .= '</table>';
    }

    /**
     * @throws NotionException
     */
    public function children(): Table
    {
        $this->children = (new NotionBlocks())->fetch($this->block['id']);

        if (! $this->children['success']) {
            $this->children = [];
        }

        return $this;
    }

    public function process(): Table
    {
        if (! count($this->children)) {
            $this->result = '';

            return $this;
        }

        Table::start();

        foreach ($this->children['data'] as $rowIndex => $row) {
            if ($row['type'] === 'table_row') {
                $this->result .= '<tr>';
                foreach ($row['table_row']['cells'] as $cellIndex => $cell) {
                    if (($rowIndex === 0 && $this->block['table']['has_column_header']) || ($cellIndex === 0 && $this->block['table']['has_row_header'])) {
                        $this->result .= '<th>';
                    } else {
                        $this->result .= '<td>';
                    }

                    foreach ($cell as $content) {
                        if ($content['text']['link'] !== null) {
                            $this->result .= "<a target='_blank' href=".$content['text']['link']['url'].'>'.$content['text']['content'].'</a>';
                        } else {
                            $this->result .= $content['text']['content'];
                        }
                    }

                    if (($rowIndex === 0 && $this->block['table']['has_column_header']) || ($cellIndex === 0 && $this->block['table']['has_row_header'])) {
                        $this->result .= '</th>';
                    } else {
                        $this->result .= '</td>';
                    }
                }
                $this->result .= '</tr>';
            }
        }

        Table::end();

        return $this;
    }

    public function render(): string
    {
        $this->previousBlock = $this->block;

        return $this->result;
    }
}
