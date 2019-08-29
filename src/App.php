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
            $args = new Args($args);
            $matched = false;
            while (!$i->eof()) {
                $list = [$i->read()];
                $fuse = new Fuse($list);
                if (count($fuse->search($args->term())) > 0) {
                    $matched = true;
                    $args->isVerbose() && $o->write($list[0]);
                }
            }
            $exitCode = $matched ? 0 : 1;
        } catch (Exception $exception) {
            $e->write($exception->getMessage());
            $e->write($exception->getTraceAsString());
            $exitCode = 2;
        } finally {
            $i->close();
            $o->close();
            $e->close();
            return $exitCode;
        }
    }
}