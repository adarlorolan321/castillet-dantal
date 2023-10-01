<?php

namespace App\Models;

use App\Models\Admin\DentalService;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class CheckupHistory extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = [
        "user_id","appointment_id","service_id","title","description","xray","date","prescription"
    ];
    protected $cast = [
        "prescription" => "array"
    ];

    public function getImagesAttribute()
    {

        $medias = $this->getMedia('xray');
        $images = [];

        foreach ($medias as $media) {
            $images[] = $media ? array_merge($media->toArray(), [
                'url' => $media->getUrl(),
                'src' => $media->getUrl(),
                'path' => $media->getUrl(),
                'preview_url' => $media->getUrl(),
            ]) : null;
        }
    
        return $images;
    }

    public function service()
    {
        return $this->belongsTo(DentalService::class);
    }

    
    

}
