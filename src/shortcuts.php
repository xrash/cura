<?php

function d($value)
{
    echo Cura::dump($value);
}

function de($value)
{
    echo Cura::dump($value);
    exit;
}

function wd($value)
{
    echo '<pre>';
    echo Cura::dump($value);
    echo '</pre>';
}

function wde($value)
{
    echo '<pre>';
    echo Cura::dump($value);
    echo '</pre>';
    exit;
}

function b($trace = null)
{
    echo Cura::backtrace($trace);
}

function wb($trace = null)
{
    echo '<pre>';
    echo Cura::backtrace($trace);
    echo '</pre>';
}

function be($trace = null)
{
    echo Cura::backtrace($trace);
    exit;
}

function wbe($trace = null)
{
    echo '<pre>';
    echo Cura::backtrace($trace);
    echo '</pre>';
    exit;
}
