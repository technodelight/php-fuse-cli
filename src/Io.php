<?php

namespace Technodelight\FuseCli;

class Io
{
    private $resource;
    private $mode;
    private $handle;

    public function __construct($handle, $mode)
    {
        $this->handle = $handle;
        $this->mode = $mode;
    }

    public function read()
    {
        $this->open();
        return fgets($this->resource);
    }

    public function write($content)
    {
        $this->open();
        fputs($this->resource, $content);
    }

    public function eof()
    {
        $this->open();
        return feof($this->resource);
    }

    public function open()
    {
        if (!$this->resource) {
            $this->resource = fopen($this->handle, $this->mode);
        }
    }

    public function close()
    {
        $this->resource && fclose($this->resource);
    }
}