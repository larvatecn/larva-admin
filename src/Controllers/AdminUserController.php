<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Controllers;

use Larva\Admin\Renderers\Page;
use Larva\Admin\Renderers\Form;
use Larva\Admin\Renderers\Operation;
use Larva\Admin\Services\AdminUserService;
use Larva\Admin\Services\AdminRoleService;

/**
 * @property AdminUserService $service
 */
class AdminUserController extends AdminController
{
    protected string $serviceName = AdminUserService::class;

    public function grid(): Page
    {
        $crud = $this->baseCRUD()
            ->headerToolbar([
                $this->createButton(true),
                ...$this->baseHeaderToolBar(),
            ])
            ->filter($this->baseFilter()->body(
                amisMake()->TextControl('keyword', __('admin.keyword'))
                    ->size('md')
                    ->placeholder(__('admin.admin_user.search_username'))
            ))
            ->columns([
                amisMake()->TableColumn('id', 'ID')->sortable(),
                amisMake()->TableColumn('avatar', __('admin.admin_user.avatar'))->type('avatar')->src('${avatar}'),
                amisMake()->TableColumn('username', __('admin.username')),
                amisMake()->TableColumn('name', __('admin.admin_user.name')),
                amisMake()->TableColumn('roles', __('admin.admin_user.roles'))->type('each')->items(
                    amisMake()->Tag()->label('${name}')->className('my-1')
                ),
                amisMake()->TableColumn('created_at', __('admin.created_at'))->type('datetime')->sortable(true),
                Operation::make()->label(__('admin.actions'))->buttons([
                    $this->rowEditButton(true),
                    $this->rowDeleteButton()->visibleOn('${id != 1}'),
                ]),
            ]);

        return $this->baseList($crud);
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            amisMake()->ImageControl('avatar', __('admin.admin_user.avatar'))->receiver($this->uploadImagePath()),
            amisMake()->TextControl('username', __('admin.username'))->required(),
            amisMake()->TextControl('name', __('admin.admin_user.name'))->required(),
            amisMake()->TextControl('password', __('admin.password'))->type('input-password'),
            amisMake()->TextControl('confirm_password', __('admin.confirm_password'))->type('input-password'),
            amisMake()->SelectControl('roles', __('admin.admin_user.roles'))
                ->searchable()
                ->multiple()
                ->labelField('name')
                ->valueField('id')
                ->joinValues(false)
                ->extractValue()
                ->options(AdminRoleService::make()->query()->get(['id', 'name'])),
        ]);
    }

    public function detail(): Form
    {
        return $this->baseDetail()->body([]);
    }
}
