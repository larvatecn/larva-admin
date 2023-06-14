<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;

class AdminRole extends BaseModel
{
    use HasTimestamps;

    public function permissions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(AdminPermission::class, 'admin_role_permissions', 'role_id', 'permission_id')
            ->withTimestamps();
    }

    protected static function boot(): void
    {
        parent::boot();
        static::deleting(function (AdminRole $model) {
            $model->permissions()->detach();
        });
    }
}
