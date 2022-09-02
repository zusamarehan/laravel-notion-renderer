<?php

namespace RehanKanak\LaravelNotionRenderer\Blocks;

class Image extends Block
{
    public $caption = '';

    public function caption(): Image
    {
        foreach ($this->block['image']['caption'] as $captions) {
            if ($captions['text']['link'] !== null) {
                $this->caption .= "<a target='_blank' href=".$captions['text']['link']['url'].">".$captions['text']['content']."</a>";
            }
            else {
                $this->caption .= $captions['text']['content'];
            }
        }

        return $this;
    }

    public function process(): Image
    {
        if ($this->block['image']['type'] === 'external') {
            $this->result .=
                "<figure>
                    <img src=".$this->block["image"]['external']['url']." alt='Image'>
                    <figcaption>".$this->caption."</figcaption>
                </figure>";
        }

        if ($this->block['image']['type'] === 'file') {
            $this->result .=
                "<figure>
                    <img src=".$this->block["image"]['file']['url']." alt='Image'>
                    <figcaption>".$this->caption."</figcaption>
                </figure>";
        }

        return $this;
    }

    public function render(): string
    {
        $this->previousBlock = $this->block;
        return $this->result;
    }
}
