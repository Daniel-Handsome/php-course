<?

namespace App\Shop\Entity;

use Illuminate\Database\Eloquent\Model;


class User extends Model{
    protected $table = 'user';


    protected $primarkey =  'id';

    protected $fillabel = [
        "emall", "password","nickname","type"
    ];

}
