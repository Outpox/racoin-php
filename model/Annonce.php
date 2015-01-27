<?php

namespace model;

class Annonce extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'annonce';
    protected $primaryKey = 'id_annonce';
    public $timestamps = false;


    public function Annonceur()
    {
        return $this->belongsTo('model\Annonceur', 'id_annonceur');
    }

    public function Photo()
    {
        return $this->hasMany('model\Photo', 'id_photo');
    }

}
?>