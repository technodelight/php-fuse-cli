<?php

namespace Technodelight\FuseCli;

class Args
{
    private $quietMode = false;
    private $term;

    public function __construct(array $arguments)
    {
        $this->parse($arguments);
    }

    public function term()
    {
        return $this->term;
    }

    public function isVerbose()
    {
        return $this->quietMode === false;
    }

    private function parse(array $arguments)
    {
        if (in_array('-q', $arguments)) {
            $this->quietMode = true;
            unset($arguments[array_search('-q', $arguments)]);
        }
        $this->term = join($arguments);
    }
}