<?php

namespace RehanKanak\LaravelNotionRenderer\Blocks;

class Heading2 extends Block
{
    private function start(): void
    {
        $this->result .= '<h2>';
    }

    private function end(): void
    {
        $this->result .= '</h2>';
    }

    public function process(): Heading2
    {
        Heading2::start();

        foreach ($this->block['heading_2']['rich_text'] as $content) {

            if ($content['text']['link'] !== null) {
                $this->result .= "<a target='_blank' href=".$content['text']['link']['url'].">".$content['text']['content']."</a>";
            }

            else {
                $this->result .= $content['text']['content'];
            }

        }

        Heading2::end();
        return $this;
    }

    public function render(): string
    {
        $this->previousBlock = $this->block;
        return $this->result;
    }
}
