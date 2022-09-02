<?php

namespace RehanKanak\LaravelNotionRenderer\Blocks;

class NumberedList
{
    public static function start(): string
    {
        return '<ol>';
    }

    public static function end(): string
    {
        return '</ol>';
    }
}
