<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name', 'value'];

    public static function value(string $name, $default = null)
    {
        return self::where('name', $name)->value('value') ?? $default;
    }
}
