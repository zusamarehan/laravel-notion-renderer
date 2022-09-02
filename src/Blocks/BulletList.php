<?php

namespace RehanKanak\LaravelNotionRenderer\Blocks;

class BulletList
{
    public static function start(): string
    {
        return '<ul>';
    }

    public static function end(): string
    {
        return '</ul>';
    }
}
