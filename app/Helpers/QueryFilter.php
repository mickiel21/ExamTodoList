<?php

namespace App\Helpers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

abstract class QueryFilter{

		public $request;
		
		public $limit;

    protected $builder;

    public function __construct(Request $request)
    {
				$this->request = $request;
				$this->limit = $request->limit ?? 15;
    }

    public function filters()
    {
        return $this->request->all();
    }

    public function search()
    {
        return $this->request->search;
    }
    
    public function apply(Builder $builder)
    {
        $this->builder = $builder;

        foreach($this->filters() as $name => $value) {
            if(method_exists($this,$name)){
               if(trim($value)){
									 $this->$name($value);
               }else {
                   $this->$name();
               }
            }
				}
				return $this->builder;
    }
}