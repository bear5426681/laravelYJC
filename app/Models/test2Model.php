<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class test2Model extends Model
{
    protected $table = 'regular_check';
    //use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'batch_number', 'site_id', 'inspection_num', 'ampm', 'dead', 'survival_num', 'failed', 'failed_remark', 'feed', 'feed_id', 'editor', 'remark', 'update_datetime'
    ];

    //public function regular_check_d()
    //{
        //return $this->hasOne(regular2Model::class, 'id');
   // }
}
