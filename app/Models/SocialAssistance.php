<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialAssistance extends Model
{
    //
    use SoftDeletes, UUID;

    protected $fillable = [
        'thumbnail',
        'name',
        'provider',
        'category',
        'amount',
        'description',
        'is_available',
    ];

    public function socialAssistanceRecipients()
    {
        return $this->hasMany(SocialAssistanceRecipient::class);
    }

}
