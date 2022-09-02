<?php

namespace RehanKanak\LaravelNotionRenderer\Blocks;

class Heading1 extends Block
{
    private function start(): void
    {
        $this->result .= '<h1>';
    }

    private function end(): void
    {
        $this->result .= '</h1>';
    }

    public function process(): Heading1
    {
        Heading1::start();

        foreach ($this->block['heading_1']['rich_text'] as $content) {

            if ($content['text']['link'] !== null) {
                $this->result .= "<a target='_blank' href=".$content['text']['link']['url'].">".$content['text']['content']."</a>";
            }

            else {
                $this->result .= $content['text']['content'];
            }

        }

        Heading1::end();
        return $this;
    }

    public function render(): string
    {
        $this->previousBlock = $this->block;
        return $this->result;
    }
}
