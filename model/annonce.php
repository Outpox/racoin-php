<?php

namespace model;

class Annonce extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'annonce';
    protected $primaryKey = 'id_annonce';
    public $timestamps = false;
}

$test = annonce::find(1);
echo $test;
echo "lel";

?>