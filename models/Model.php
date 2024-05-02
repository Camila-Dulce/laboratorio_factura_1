<?php

namespace App\models;

class Model
{
    function get($prop)
    {
        return $this->{$prop} ?? null;
    }

    function set($prop, $value)
    {
        $this->{$prop} = $value;
    }
}
