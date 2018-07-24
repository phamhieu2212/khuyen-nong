<?php namespace App\Models;



class Certificate extends Base
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'certificates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'type',
        'description',
        'logo_image_id',
        'cover_image_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\CertificatePresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\CertificateObserver);
    }

    // Relations
    public function logoImage()
    {
        return $this->hasOne(\App\Models\Image::class, 'id', 'logo_image_id');
    }

    public function coverImage()
    {
        return $this->hasOne(\App\Models\Image::class, 'id', 'cover_image_id');
    }

    

    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'type' => $this->type,
            'description' => $this->description,
            'logo_image_id' => $this->logo_image_id,
            'cover_image_id' => $this->cover_image_id,
        ];
    }

}
