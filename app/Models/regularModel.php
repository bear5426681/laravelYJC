<?php


namespace App\Models;

use App\Models\regular2Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class regularModel extends Model
{
    protected $table = 'regular_check';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'batch_number', 'site_id', 'ampm', 'inspection_num',
    ];

    public function regular_check_d()
    {
        return $this->hasOne(regular2Model::class, 'id');
    }
}
