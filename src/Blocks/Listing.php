<?php

namespace RehanKanak\LaravelNotionRenderer\Blocks;

class Listing extends Block
{
    private function start(): void
    {
        $this->result .= '<li>';
    }

    public function process(): Listing
    {
        Listing::start();

        foreach ($this->block[$this->block['type']]['rich_text'] as $content) {
            if ($content['text']['link'] !== null) {
                $this->result .= "<a target='_blank' href=".$content['text']['link']['url'].'>'.$content['text']['content'].'</a>';
            } else {
                $this->result .= $content['text']['content'];
            }
        }

        Listing::end();

        return $this;
    }

    private function end(): void
    {
        $this->result .= '</li>';
    }

    public function render(): string
    {
        $this->previousBlock = $this->block;

        return $this->result;
    }
}
