<?php

namespace Technodelight\FuseCli;

use Exception;
use Fuse\Fuse;

class App
{
    public function run(array $args = []): int
    {
        try {
            $i = new Io('php://stdin', 'r');
            $o = new Io('php://stdout', 'w');
            $e = new Io('php://stderr', 'w');
            $term = join(' ', $args);
            while (!$i->eof()) {
                $list = [$i->read()];
                $fuse = new Fuse($list);
                if (count($fuse->search($term)) > 0) {
                    $o->write($list[0]);
                }
            }
            $exitCode = 0;
        } catch (Exception $exception) {
            $e->write($exception->getMessage());
            $e->write($exception->getTraceAsString());
            $exitCode = 1;
        } finally {
            $i->close();
            $o->close();
            $e->close();
            return $exitCode;
        }
    }
}