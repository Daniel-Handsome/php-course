<?php

namespace App\Shop\Entity;

use Illuminate\Database\Eloquent\Model;

class Narchdise extends Model{
    protected $table = 'merchandise';

    protected $primaryKey =  'id';

    protected $fillable = [
        "status","name","name_en","introduction","introduction_en","price","photo","remain_count"
    ];

    public function merchandise(){
        return $this->hasOne('App\Shop\Entity\merchandise','merchdise_id','id');
    }
}
?>
