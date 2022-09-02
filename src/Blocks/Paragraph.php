<?php

namespace RehanKanak\LaravelNotionRenderer\Blocks;

class Paragraph extends Block
{
    private function start(): void
    {
        $this->result .= '<p>';
    }

    private function end(): void
    {
        $this->result .= '</p>';
    }

    public function process(): Paragraph
    {
        Paragraph::start();

        foreach ($this->block['paragraph']['rich_text'] as $content) {

            if ($content['text']['link'] !== null) {
                $this->result .= "<a target='_blank' href=".$content['text']['link']['url'].">".$content['text']['content']."</a>";
            }

            else {
                $this->result .= $content['text']['content'];
            }

        }

        Paragraph::end();
        return $this;
    }

    public function render(): string
    {
        $this->previousBlock = $this->block;
        return $this->result;
    }
}
