<?php

namespace model;

class Annonceur extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'annonceur';
    protected $primaryKey = 'id_annonceur';
    public $timestamps = false;

    public function Annonce()
    {
        return $this->hasMany('model\Annonce', 'id_annonce');
    }
}

?>