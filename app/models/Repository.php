<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Repository extends Eloquent {
	protected $guarded = array();
    public $timestamps = false;

    protected $dates = ['deleted_at'];

	public static $rules = array(
		'name' => 'required',
		'description'=>'required',
        'owner_id' => 'required'
	);
    public function getDates(){
        return array();
    }
}
