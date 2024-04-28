<?php

namespace App\models;

class Model
{
    function get($prop)
    {
        return $this->{$prop};
    }

    function set($prop, $value)
    {
        $this->{$prop} = $value;
    }
}
