<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory;

    /**
     */
    public function getPublicUrlAttribute()
    {
        return 'https://chronicle.avgust.dev/94f8849e-358a-45f5-82e6-2cce6d0d8cca/' . $this->path;
        return Storage::disk('s3')->exists($this->path)
            ? Storage::disk('s3')->ge
            : 'https://www.slntechnologies.com/wp-content/uploads/2017/08/ef3-placeholder-image.jpg';
    }

}
