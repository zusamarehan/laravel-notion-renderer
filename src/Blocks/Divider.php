<?php

namespace RehanKanak\LaravelNotionRenderer\Blocks;

class Divider extends Block
{

    public function process(): Divider
    {
		$this->result .= '<div class="divide-y"></div>';

        return $this;
    }

    public function render(): string
    {
        $this->previousBlock = $this->block;

        return $this->result;
    }
}
