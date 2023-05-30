<?php

namespace Larva\Admin\Services;

use Illuminate\Support\Arr;
use Larva\Admin\Models\AdminRole;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @method AdminRole getModel()
 * @method AdminRole|Builder query()
 */
class AdminRoleService extends AdminService
{
    protected string $modelName = AdminRole::class;

    public function getEditData($id): Model|\Illuminate\Database\Eloquent\Collection|Builder|array|null
    {
        $permission = parent::getEditData($id);

        $permission->load(['permissions']);

        return $permission;
    }

    public function store($data): bool
    {
        if ($this->hasRepeated($data)) {
            return false;
        }

        $columns = $this->getTableColumns();

        $model = $this->getModel();

        foreach ($data as $k => $v) {
            if (!in_array($k, $columns)) {
                continue;
            }

            $model->setAttribute($k, $v);
        }

        return $model->save();
    }

    public function update($primaryKey, $data): bool
    {
        if ($this->hasRepeated($data, $primaryKey)) {
            return false;
        }

        $columns = $this->getTableColumns();

        $model = $this->query()->whereKey($primaryKey)->first();

        foreach ($data as $k => $v) {
            if (!in_array($k, $columns)) {
                continue;
            }

            $model->setAttribute($k, $v);
        }

        return $model->save();
    }

    public function hasRepeated($data, $id = 0): bool
    {
        $query = $this->query()->when($id, fn($query) => $query->where('id', '<>', $id));

        if ((clone $query)->where('name', $data['name'])->exists()) {
            $this->setError(__('admin.admin_role.name_already_exists'));
            return true;
        }

        if ((clone $query)->where('slug', $data['slug'])->exists()) {
            $this->setError(__('admin.admin_role.slug_already_exists'));
            return true;
        }

        return false;
    }

    public function savePermissions($primaryKey, $permissions)
    {
        $model = $this->query()->whereKey($primaryKey)->first();

        return $model->permissions()->sync(
            Arr::has($permissions, '0.id') ? Arr::pluck($permissions, 'id') : $permissions
        );
    }
}
