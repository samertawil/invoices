<?php

namespace App\Models;


class invoice extends BaseModel
{


    protected $casts =[
        'attchments' => 'json',
    ];
    

}
