<?php

namespace RehanKanak\LaravelNotionRenderer\Blocks;

class Callout extends Block
{
    private function start(): void
    {
        $classes = 'border-rounded my-1 text-gray-800 ';

        if ($this->block['callout']['color'] === 'default') {
            $classes = 'bg-white border border-gray-200 border-solid';
        } elseif (str_contains($this->block['callout']['color'], '_background')) {
            $color = str_replace('_background', '', $this->block['callout']['color']);

            $classes .= 'text-black bg-';
            $classes .= $color !== 'brown' ? $color : 'zinc';
            $classes .= '-100';
        } else {
            $color = $this->block['callout']['color'];

            $classes .= 'bg-white border border-gray-200 border-solid text-';
            $classes .= $color !== 'brown' ? $color : 'zinc';
            $classes .= '-700';
        }

        $this->result .= '<div class="'.$classes.'">';
        $this->result .= '<div class="flex p-4 pl-3">';
    }

    public function addIcon(): void
    {
        $this->result .= '<div>';

        if ($this->block['callout']['icon']['type'] === 'emoji') {
            $this->result .= '<div class="flex justify-center items-center h-6 w-6 rounded text-base leading-none">';
            $this->result .= '<div class="h-4 w-4">';
            $this->result .= $this->block['callout']['icon']['emoji'];
            $this->result .= '</div>';
        } else {
            $url = $this->block['callout']['icon'][$this->block['callout']['icon']['type']]['url'];

            $this->result .= '<div class="flex justify-center items-center h-6 w-6 rounded">';
            $this->result .= '<img src="'.$url.'"  class="block w-full h-full border-rounded" />';
        }

        $this->result .= '</div>';
        $this->result .= '</div>';
    }

    private function end(): void
    {
        $this->result .= '</div>';
        $this->result .= '</div>';
    }

    public function process(): Callout
    {
        $this->start();

        $this->addIcon();

        foreach ($this->block['callout']['rich_text'] as $content) {
            if ($content['text']['link'] !== null) {
                $this->result .= "<a target='_blank' href=".$content['text']['link']['url'].'>'.$content['text']['content'].'</a>';
            } else {
                $this->result .= '<div class="ml-2 px-0.5 whitespace-pre-wrap">';
                $this->result .= $content['text']['content'];
                $this->result .= '</div>';
            }
        }

        $this->end();

        return $this;
    }

    public function render(): string
    {
        $this->previousBlock = $this->block;

        return $this->result;
    }
}
