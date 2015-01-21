<?php

namespace Model;

class annonce extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'annonce';
    protected $id = 'id_annonce';
    public $timestamps = false;
}

$test = annonce::find(1);
echo $test;
echo "lel";

?>