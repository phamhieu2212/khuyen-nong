<?php namespace App\Models;



class ProductUnit extends Base
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_units';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_id',
        'unit_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\ProductUnitPresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\ProductUnitObserver);
    }

    // Relations
    public function product()
    {
        return $this->belongsTo(\App\Models\Product::class, 'product_id', 'id');
    }

    public function unit()
    {
        return $this->belongsTo(\App\Models\Unit::class, 'unit_id', 'id');
    }

    

    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id' => $this->id,
            'product_id' => $this->product_id,
            'unit_id' => $this->unit_id,
        ];
    }

}
