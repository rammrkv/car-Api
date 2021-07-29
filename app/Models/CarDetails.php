<?php

namespace App\Models;

class CarDetails extends Model
{
    public function getTable()
    {
        return $this->table = 'car_details';
    }
    
    protected $primaryKey = 'car_id';
    
    public $email = '';


    protected $fillable = [
    'user_id', 'brand', 'model', 'model_year', 'colour', 'registration_no', 'mileage_drove', 'status' , 'is_published'
    ];

	public function user(){

		return $this->belongsTo('App\Models\UserDetails','user_id');

	}
}
