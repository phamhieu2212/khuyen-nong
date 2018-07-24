<?php namespace App\Models;



class FarmerCertificate extends Base
{

    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'farmer_certificates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'admin_user_id',
        'cetificate_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates  = [];

    protected $presenter = \App\Presenters\FarmerCertificatePresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\FarmerCertificateObserver);
    }

    // Relations
    public function adminUser()
    {
        return $this->belongsTo(\App\Models\AdminUser::class, 'admin_user_id', 'id');
    }

    public function cetificate()
    {
        return $this->belongsTo(\App\Models\Cetificate::class, 'cetificate_id', 'id');
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
            'cetificate_id' => $this->cetificate_id,
        ];
    }

}
