<?php namespace App\Models;



class Htx extends Base
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'htxes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'address',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\HtxPresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\HtxObserver);
    }

    // Relations
    

    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'address' => $this->address,
        ];
    }

}
