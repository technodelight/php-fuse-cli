<?php

namespace Technodelight\FuseCli;

class Args
{
    private $quietMode = false;
    /**
     * @var float
     */
    private $threshold = 0.4;
    private $term;

    public function __construct(array $arguments)
    {
        $this->parse($arguments);
    }

    public function term()
    {
        return $this->term;
    }

    public function threshold()
    {
        return $this->threshold;
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
        foreach ($arguments as $k => $v) {
            if (trim($v) == '-q') {
                $this->quietMode = true;
                unset($arguments[$k]);
            } else if (strpos($v, '-t') !== false) {
                $this->threshold = (float) trim(substr($v, strpos($v, '-t') + 2));
                unset($arguments[$k]);
            }
        }

        $this->term = join($arguments);
    }
}