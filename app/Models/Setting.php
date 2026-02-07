<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['name', 'value'];

    public function defaultProfilePicture()
    {
        $defaultProfilePicture = Setting::where('name', 'defaultProfilePicture');
        return $defaultProfilePicture->value;
    }

    public function defaultThumbnail()
    {
        $defaultThumbnail = Setting::where('name', 'defaultThumbnail');
        return $defaultThumbnail->value;
    }
}
