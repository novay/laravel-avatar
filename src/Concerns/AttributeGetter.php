<?php

declare(strict_types=1);

namespace Novay\Avatar\Concerns;

trait AttributeGetter
{
    public function getAttribute($key)
    {
        return $this->$key;
    }
}