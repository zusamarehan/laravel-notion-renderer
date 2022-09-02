<?php

namespace RehanKanak\LaravelNotionRenderer\Blocks;

class Quote extends Block
{
    private function start(): void
    {
        $this->result .= '<blockquote>';
    }

    private function end(): void
    {
        $this->result .= '</blockquote>';
    }

    public function process(): Quote
    {
        Quote::start();

        foreach ($this->block['quote']['rich_text'] as $content) {

            if ($content['text']['link'] !== null) {
                $this->result .= "<a target='_blank' href=".$content['text']['link']['url'].">".$content['text']['content']."</a>";
            }

            else {
                $this->result .= $content['text']['content'];
            }

        }

        Quote::end();
        return $this;
    }

    public function render(): string
    {
        $this->previousBlock = $this->block;
        return $this->result;
    }
}
