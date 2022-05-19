<?php

namespace Novay\Avatar\Generator;

interface GeneratorInterface
{
    public function make($name, $length, $uppercase, $ascii, $rtl);
}
