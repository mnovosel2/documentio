<?php
use Illuminate\Database\Eloquent\SoftDeletingTrait;
class Document extends Eloquent {
    protected $guarded = array();
    public $timestamps = false;

    protected $dates = ['deleted_at'];

    public static $rules = array(
        'heading' => 'required',
        'subheading'=>'required',
        'abstract' => 'required',
        'content'=>'required',
        'tags'=>'required',
        'format'=>'required'
    );
    public function versions(){
        return $this->hasMany('Version');
    }
    public function getDates(){
        return array();
    }
}
