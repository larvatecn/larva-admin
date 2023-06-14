<?php
/**
 * This is NOT a freeware, use is subject to license terms.
 *
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 */

namespace Larva\Admin\Console;

use Illuminate\Console\Command;
use Larva\Admin\Models\AdminUser;
use Larva\Admin\Models\AdminRole;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'admin:create-user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建管理员用户';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $username = $this->ask('Please enter a username to login');

        $password = bcrypt($this->secret('Please enter a password to login'));

        $name = $this->ask('Please enter a name to display');

        $roles = AdminRole::all();

        /** @var array $selected */
        $selected =
            $this->choice('Please choose a role for the user', $roles->pluck('name')->toArray(), null, null, true);

        $roles = $roles->filter(function ($role) use ($selected) {
            return in_array($role->name, $selected);
        });

        $user = new AdminUser(compact('username', 'password', 'name'));

        $user->save();

        $user->roles()->attach($roles);

        $this->info("User [$name] created successfully.");
    }
}
