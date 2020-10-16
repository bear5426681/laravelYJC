<?php


namespace App\Models;

use App\Models\regularModel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class regular2Model extends Model
{
    protected $table = 'regular_check_d';
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'inspection_num', 'check1', 'check2',
    ];

    public function regular_check()
    {
        return $this->belongsTo(regularModel::class, 'id');
    }
}
