<?php namespace App\Models;



class Product extends Base
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'category_id',
        'cover_image_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\ProductPresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\ProductObserver);
    }

    // Relations
    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class, 'category_id', 'id');
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
            'category_id' => $this->category_id,
            'cover_image_id' => $this->cover_image_id,
        ];
    }

}
