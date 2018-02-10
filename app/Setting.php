<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    /**
     * Get Setting with the path
     * @param $query
     * @param $path
     * @return mixed
     */
    public function scopePath($query, $path)
    {
        return $query->where('path', $path);
    }
}
