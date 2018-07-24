<?php namespace App\Models;



class Farmer extends Base
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'farmers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_user_id',
        'longtitude',
        'latitude',
        'type',
        'htx_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\FarmerPresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\FarmerObserver);
    }

    // Relations
    public function adminUser()
    {
        return $this->belongsTo(\App\Models\AdminUser::class, 'admin_user_id', 'id');
    }

    public function htx()
    {
        return $this->belongsTo(\App\Models\Htx::class, 'htx_id', 'id');
    }

    

    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id' => $this->id,
            'admin_user_id' => $this->admin_user_id,
            'longtitude' => $this->longtitude,
            'latitude' => $this->latitude,
            'type' => $this->type,
            'htx_id' => $this->htx_id,
        ];
    }

}
