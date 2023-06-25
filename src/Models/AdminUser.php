<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Collection;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Foundation\Auth\User;

/**
 * 管理员用户模型
 * @property int $id 管理员ID
 * @property int $user_id 用户ID
 * @property string $username 用户名
 * @property string $password 密码
 * @property string $name 姓名
 * @property string $avatar 头像
 * @property string $remember_token 记住我 Token
 * @property $created_at 创建时间
 * @property $updated_at 更新时间
 * @property \App\Models\User $user 前台用户
 * @property AdminRole[] $roles 角色
 */
class AdminUser extends User implements AuthenticatableContract
{
    use Authenticatable, HasApiTokens;

    protected $guarded = [];

    /**
     * Perform any actions required before the model boots.
     *
     * @return void
     */
    protected static function booting(): void
    {
        parent::booting();
        static::creating(function (AdminUser $model) {
            if (class_exists(\App\Services\UserService::class)) {
                $user = \App\Services\UserService::createUser($model->username);
                $model->user_id = $user->id;
            }
        });
        static::deleting(function (AdminUser $model) {
            $model->roles()->detach();
        });
    }
    
    protected function serializeDate(\DateTimeInterface $date): string
    {
        return $date->format($this->getDateFormat());
    }

    /**
     * 定义用户关系
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * 角色关系定义
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(AdminRole::class, 'admin_role_users', 'user_id', 'role_id')->withTimestamps();
    }

    public function avatar(): Attribute
    {
        $storage = \Illuminate\Support\Facades\Storage::disk(config('admin.upload.disk'));

        return Attribute::make(
            get: fn($value) => $value ? admin_resource_full_path($value) : url(config('admin.default_avatar')),
            set: fn($value) => str_replace($storage->url(''), '', $value)
        );
    }

    public function allPermissions(): Collection
    {
        return $this->roles()->with('permissions')->get()->pluck('permissions')->flatten();
    }

    public function can($abilities, $arguments = []): bool
    {
        if (empty($abilities)) {
            return true;
        }

        if ($this->isAdministrator()) {
            return true;
        }

        return $this->roles->pluck('permissions')->flatten()->pluck('slug')->contains($abilities);
    }

    /**
     * 是否是超级管理员
     */
    public function isAdministrator(): bool
    {
        return $this->isRole('administrator');
    }

    /**
     * 判断该用户是否属于指定角色
     *
     * @param string $role
     */
    public function isRole(string $role): bool
    {
        return $this->roles->pluck('slug')->contains($role);
    }

    public function inRoles(array $roles = []): bool
    {
        return $this->roles->pluck('slug')->intersect($roles)->isNotEmpty();
    }

    public function visible(array $roles = []): bool
    {

        if ($this->isAdministrator()) {
            return true;
        }
        if (empty($roles)) {
            return false;
        }
        $roles = array_column($roles, 'slug');

        return $this->inRoles($roles);
    }
}
