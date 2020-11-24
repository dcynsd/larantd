<?php

namespace App\Admin\Models;

use App\Admin\Utils\Traits\DefaultDatetimeFormat;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as EloquentModel;

class Model extends EloquentModel
{
    use DefaultDatetimeFormat, HasFactory;
}
