<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Extension extends Model
{
    protected $fillable = ['name', 'is_enabled', 'options'];

    protected $casts = [
        'options' => 'json',
    ];

    protected $table = 'admin_extensions';
}
