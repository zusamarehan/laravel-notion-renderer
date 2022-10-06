<?php

namespace RehanKanak\LaravelNotionRenderer\Blocks;

class Divider extends Block
{
    public function process(): Divider
    {
        $this->result .= '<div class="border-b my-1"></div>';

        return $this;
    }

    public function render(): string
    {
        $this->previousBlock = $this->block;

        return $this->result;
    }
}
