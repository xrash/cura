<?php

function b($trace)
{
    echo Cura::backtrace($trace);
}

function wb($trace)
{
    echo '<pre>';
    echo Cura::backtrace($trace);
    echo '</pre>';
}

function be($trace)
{
    echo Cura::backtrace($trace);
    exit;
}

function wbe($trace)
{
    echo '<pre>';
    echo Cura::backtrace($trace);
    echo '</pre>';
    exit;
}
