<?php

class Cura
{
    public static function backtrace()
    {
        $frames = debug_backtrace(0);
        $output = array();
        $i = count($frames);

        foreach ($frames as $frame) {
            $output[] = sprintf('%d. %s', $i--, self::where($frame));
            $output[] = sprintf('  %s', self::who($frame));
        }

        return sprintf("\n%s\n", implode("\n", $output));
    }

    private static function where($frame)
    {
        return sprintf('%s:%d', $frame['file'], $frame['line']);
    }

    private static function who($frame)
    {
        if (isset($frame['class'])) {
            return sprintf('%s::%s(%s)', $frame['class'], $frame['function'], self::args($frame));
        } else {
            return sprintf('%s(%s)', $frame['function'], self::args($frame));
        }
    }

    private static function args($frame)
    {
        $args = array();

        foreach ($frame['args'] as $arg) {
            switch (true) {
                case is_int($arg):
                case is_string($arg):
                    $args[] = $arg;
                    break;
                case is_array($arg):
                    $args[] = sprintf('array#%d', count($arg));
                    break;
                case is_object($arg):
                    $args[] = sprintf('object#%s', get_class($arg));
                    break;
                case is_resource($arg):
                    $args[] = sprintf('resource#%s', get_resource_type($arg));
                    break;
                default:
                    $args[] = $arg;
            }
        }

        return implode(', ', $args);
    }
}
