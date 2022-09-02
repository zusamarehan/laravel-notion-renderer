<?php

namespace RehanKanak\LaravelNotionRenderer\Blocks;

class Heading3 extends Block
{
    private function start(): void
    {
        $this->result .= '<h3>';
    }

    private function end(): void
    {
        $this->result .= '</h3>';
    }

    public function process(): Heading3
    {
        Heading3::start();

        foreach ($this->block['heading_3']['rich_text'] as $content) {

            if ($content['text']['link'] !== null) {
                $this->result .= "<a target='_blank' href=".$content['text']['link']['url'].">".$content['text']['content']."</a>";
            }

            else {
                $this->result .= $content['text']['content'];
            }

        }

        Heading3::end();
        return $this;
    }

    public function render(): string
    {
        $this->previousBlock = $this->block;
        return $this->result;
    }
}
