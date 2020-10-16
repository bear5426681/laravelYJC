<?php


use App\Models\regularModel;






function survival_num(){
    $survival_num=regularModel::orderBy('id','desc')->pluck('survival_num')->first();
    return ['survival_num'=>$survival_num] ;
}
