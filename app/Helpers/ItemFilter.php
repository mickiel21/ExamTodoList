<?php

namespace App\Helpers;

use App\Helpers\QueryFilter;

class ItemFilter extends QueryFilter{

    public function search($search=''){
        if(trim($search) && $search != ''){
            $this->filter($search);
        }
    }

    /* Type Column Filtering */
    public function filter($search){
		return $this->builder->where('name', 'LIKE', '%' . $search . '%');
    }
} 