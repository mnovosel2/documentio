<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Version extends Eloquent {
    protected $guarded = array();
    public $timestamps=false;

    protected $dates = ['deleted_at'];

    public static $rules = array(
        'document_id'=>'required',
        'version_hash'=>'required',
        'identifier'=>'required'
    );
    public function document(){
       return $this->belongsTo('Document','document_id');
    }
}