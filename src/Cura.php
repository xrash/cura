<?php

class Cura
{

    public static function dump($value)
    {
        $type = gettype($value);

        $info = array();

        switch ($type) {
            case 'array':
                $info[] = sprintf('type: array (%d)', count($value));
                $info[] = sprintf('value: %s', var_export($value, true));
                break;

            case 'object':
                $info[] = sprintf('type: object (%s)', get_class($value));
                $info[] = sprintf('value: %s', var_export($value, true));
                break;

            case 'resource':
                $info[] = sprintf('type: resource (%s)', get_resource_type($value));
                $info[] = sprintf('value: %s', var_export($value, true));
                break;

            default:
                $info[] = sprintf('type: %s', $type);
                $info[] = sprintf('value: %s', $value);
                break;
        }

        return sprintf("\n%s\n", implode("\n", $info));
    }

    public static function backtrace($trace)
    {
        if (!$trace) {
            $trace = debug_backtrace();
        }

        if ($trace instanceof \Exception) {
            $trace = $trace->getTrace();
        }

        $output = array();
        $i = count($trace);

        foreach ($trace as $frame) {
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
            $type = gettype($arg);

            switch ($type) {
                case 'array':
                    $args[] = sprintf('array#%d', count($arg));
                    break;
                case 'object':
                    $args[] = sprintf('object#%s', get_class($arg));
                    break;
                case 'resource':
                    $args[] = sprintf('resource#%s', get_resource_type($arg));
                    break;
                default:
                    $args[] = $arg;
            }
        }

        return implode(', ', $args);
    }
}
