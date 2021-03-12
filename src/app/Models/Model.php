<?php

namespace App\Models;

use Core\App;
use Core\Database\QueryBuilder;

abstract class Model //extends QueryBuilder
{
    public function __construct(array $attributes = [])
    {
        // parent::__construct(App::get('database'));
        $this->fill($attributes);
    }

    public function fill(array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $this->setAttribute($key, $value);
        }

        return $this;
    }

    public function setAttribute($key, $value)
    {
        $this->{$key} = $value;

        return $this;
    }
}
