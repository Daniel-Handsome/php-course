<?php

namespace App\Shop\Entity;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model{
    protected $table = 'merchandise';

    protected $primaryKey =  'id';

    protected $fillable = [
        "status","name","name_en","introduction","introduction_en","price","photo","remain_count"
    ];

    public function transaction(){
        return $this->belongsTo('App\Shop\Entity','transaction_id','id');
    }
}
?>
