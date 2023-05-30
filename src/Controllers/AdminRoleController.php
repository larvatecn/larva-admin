<?php

namespace Larva\Admin\Controllers;

use Larva\Admin\Renderers\Page;
use Larva\Admin\Renderers\Form;
use Larva\Admin\Services\AdminRoleService;
use Larva\Admin\Services\AdminPermissionService;

/**
 * @property AdminRoleService $service
 */
class AdminRoleController extends AdminController
{
    protected string $serviceName = AdminRoleService::class;

    public function list(): Page
    {
        $crud = $this->baseCRUD()
            ->headerToolbar([
                $this->createButton(true),
                ...$this->baseHeaderToolBar(),
            ])
            ->filterTogglable(false)
            ->columns([
                amisMake()->TableColumn()->label('ID')->name('id')->sortable(),
                amisMake()->TableColumn()->label(__('admin.admin_role.name'))->name('name'),
                amisMake()->TableColumn()->label(__('admin.admin_role.slug'))->name('slug')->type('tag'),
                amisMake()->TableColumn()
                    ->label(__('admin.created_at'))
                    ->name('created_at')
                    ->type('datetime')
                    ->sortable(true),
                amisMake()->TableColumn()
                    ->label(__('admin.updated_at'))
                    ->name('updated_at')
                    ->type('datetime')
                    ->sortable(true),
                amisMake()->Operation()->label(__('admin.actions'))->buttons([
                    $this->setPermission(),
                    $this->rowEditButton(true),
                    $this->rowDeleteButton()->visibleOn('${slug != "administrator"}'),
                ]),
            ]);

        return $this->baseList($crud)->css([
            '.tree-full'                               => [
                'overflow' => 'hidden !important',
            ],
            '.cxd-TreeControl > .cxd-Tree' => [
                'height'     => '100% !important',
                'max-height' => '100% !important',
            ],
        ]);
    }

    protected function setPermission()
    {
        return amisMake()->DrawerAction()->label('设置权限')->icon('fa-solid fa-gear')->level('link')->drawer(
            amisMake()->Drawer()->title('设置权限')->resizable()->closeOnOutside()->closeOnEsc()->body([
                amisMake()
                    ->Form()
                    ->api(admin_url('system/admin_role_save_permissions'))
                    ->initApi($this->getEditGetDataPath())
                    ->mode('normal')
                    ->data(['id' => '${id}'])
                    ->body([
                        amisMake()->TreeControl()
                            ->name('permissions')
                            ->label()
                            ->multiple()
                            ->options(AdminPermissionService::make()->getTree())
                            ->searchable()
                            ->onlyChildren()
                            ->joinValues(false)
                            ->extractValue()
                            ->size('full')
                            ->className('h-full b-none')
                            ->inputClassName('h-full tree-full')
                            ->labelField('name')
                            ->valueField('id'),
                    ]),
            ])->footer([
                amisMake()->Button()->label('保存')->type('submit')->level('primary'),
            ])
        );
    }

    public function savePermissions()
    {
        $result = $this->service->savePermissions(request('id'), request('permissions'));

        return $this->autoResponse($result, __('admin.save'));
    }

    public function form(): Form
    {
        return $this->baseForm()->body([
            amisMake()->TextControl()->label(__('admin.admin_role.name'))->name('name')->required(),
            amisMake()->TextControl()
                ->label(__('admin.admin_role.slug'))
                ->name('slug')
                ->description(__('admin.admin_role.slug_description'))
                ->required(),
        ]);
    }

    public function detail(): Form
    {
        return $this->baseDetail()->body([]);
    }
}
