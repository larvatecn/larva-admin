<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('user_id')->comment('前台用户');
            $table->string('username', 120)->unique();
            $table->string('password', 80);
            $table->string('name');
            $table->string('avatar')->nullable();
            $table->string('remember_token', 100)->nullable();
            $table->timestamps();
            $table->comment('管理员用户表');
        });

        Schema::create('admin_roles', function (Blueprint $table) {
            $table->increments('id')->comment('角色ID');
            $table->string('name', 50)->unique()->comment('角色名称');
            $table->string('slug', 50)->unique()->comment('角色标识');
            $table->timestamps();
            $table->comment('管理员角色表');
        });

        Schema::create('admin_permissions', function (Blueprint $table) {
            $table->increments('id')->comment('权限ID');
            $table->string('name', 50)->unique()->comment('权限名称');
            $table->string('slug', 50)->unique()->comment('权限标识');
            $table->text('http_method')->nullable()->comment('HTTP方法');
            $table->text('http_path')->nullable()->comment('HTTP Path');
            $table->integer('order')->default(0)->comment('排序');
            $table->integer('parent_id')->default(0)->comment('父权限');
            $table->timestamps();
            $table->comment('管理员权限表');
        });

        Schema::create('admin_menus', function (Blueprint $table) {
            $table->increments('id')->comment('菜单ID');
            $table->integer('parent_id')->default(0)->comment('父菜单ID');
            $table->integer('order')->default(0)->comment('排序');
            $table->string('title', 100)->comment('菜单名称');
            $table->string('icon', 100)->nullable()->comment('菜单图标');
            $table->string('url')->nullable()->comment('菜单路由');
            $table->tinyInteger('url_type')->default(1)->comment('路由类型(1:路由,2:外链)');
            $table->tinyInteger('visible')->default(1)->comment('是否可见');
            $table->tinyInteger('is_home')->default(0)->comment('是否为首页');
            $table->string('extension')->nullable()->comment('扩展');

            $table->timestamps();
            $table->comment('后台菜单');
        });

        Schema::create('admin_role_users', function (Blueprint $table) {
            $table->integer('role_id')->comment('角色ID');
            $table->integer('user_id')->comment('用户ID');
            $table->index(['role_id', 'user_id']);
            $table->timestamps();
            $table->comment('管理员角色用户表');
        });

        Schema::create('admin_role_permissions', function (Blueprint $table) {
            $table->integer('role_id')->comment('角色ID');
            $table->integer('permission_id')->comment('权限ID');
            $table->index(['role_id', 'permission_id']);
            $table->timestamps();
            $table->comment('管理员角色权限表');
        });

        Schema::create('admin_permission_menu', function (Blueprint $table) {
            $table->integer('permission_id')->comment('权限ID');
            $table->integer('menu_id')->comment('菜单ID');
            $table->index(['permission_id', 'menu_id']);
            $table->timestamps();
            $table->comment('管理员权限菜单表');
        });

        Schema::create('admin_settings', function (Blueprint $table) {
            $table->string('key')->comment('配置Key');;
            $table->longText('values')->comment('配置值');;
            $table->timestamps();
            $table->comment('系统配置表');
        });

        Schema::create('admin_extensions', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->unique();
            $table->tinyInteger('is_enabled')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_users');
        Schema::dropIfExists('admin_roles');
        Schema::dropIfExists('admin_permissions');
        Schema::dropIfExists('admin_menus');
        Schema::dropIfExists('admin_role_users');
        Schema::dropIfExists('admin_role_permissions');
        Schema::dropIfExists('admin_permission_menu');
        Schema::dropIfExists('admin_settings');
        Schema::dropIfExists('admin_extensions');
    }
};
