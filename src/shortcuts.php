<?php

function b()
{
    echo Cura::backtrace();
}

function wb()
{
    echo '<pre>';
    echo Cura::backtrace();
    echo '</pre>';
}

function be()
{
    echo Cura::backtrace();
    exit;
}

function wbe()
{
    echo '<pre>';
    echo Cura::backtrace();
    echo '</pre>';
    exit;
}
