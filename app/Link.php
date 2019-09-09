<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'links';

    protected $fillable = ['original_link', 'short_link'];

    public function getShortLink()
    {
        return env('APP_URL') . '/link/' . base64_encode($this->id);
    }
}
