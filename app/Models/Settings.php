<?php

namespace App\Models;

use App\Models\Traits\Settings\GetSetting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Settings extends Model
{
    use HasFactory, SoftDeletes, GetSetting;

    protected $table = "settings";


    public function delete()
    {
        throw new \Exception('Deleting is not allowed');
    }

    public function forceDelete()
    {
        throw new \Exception('Deleting is not allowed');
    }
}
