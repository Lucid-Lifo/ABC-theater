<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class users_db extends Model
    {
        protected $table = 'users_info';

        protected $fillable = ['name', 'email', 'password'];
        
        public $timestamps = false;
    }
