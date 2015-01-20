<?php

namespace model;

class Photo extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'photo';
    protected $id = 'id_photo';
    public $timestamps = false;
}

?>