<?php

use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addUserPermission();
        $this->addPermissionCms();
    }

    public function addUserPermission()
    {
        $groupId = \Modules\core\models\PermissionGroup::create([
            'title' => 'Permission User',
            'description' => 'Permission user group'
        ]);

        $permissionUser = [
            [
                'name' => 'canCreateUser',
                'description' => 'User can create new user',
                'group_id' => $groupId->group_id
            ],
            [
                'name' => 'canUpdateUser',
                'description' => 'User can update info user',
                'group_id' => $groupId->group_id
            ],
            [
                'name' => 'canViewListUser',
                'description' => 'User can view list user',
                'group_id' => $groupId->group_id
            ],
            [
                'name' => 'canRemoveUser',
                'description' => 'User can remove a user',
                'group_id' => $groupId->group_id
            ]
        ];

        foreach ($permissionUser as $permission) {
            \Modules\core\models\Permission::create($permission);
        }
    }

    public function addPermissionCms()
    {
        $groupId = \Modules\core\models\PermissionGroup::create([
            'title' => 'Permission Post',
            'description' => 'Permission Post'
        ]);

        $permissionPost = [
            [
                'name' => 'canCreatePostCat',
                'description' => 'User can create new Post Category',
                'group_id' => $groupId->group_id
            ],
            [
                'name' => 'canUpdatePostCat',
                'description' => 'User can update Post Category',
                'group_id' => $groupId->group_id
            ],
            [
                'name' => 'canViewListPostCat',
                'description' => 'User can view list Post Category',
                'group_id' => $groupId->group_id
            ],
            [
                'name' => 'canRemovePostCat',
                'description' => 'User can remove a Post Category',
                'group_id' => $groupId->group_id
            ],
            [
                'name' => 'canViewListPost',
                'description' => 'User can view list Post',
                'group_id' => $groupId->group_id
            ],
            [
                'name' => 'canViewDetailPost',
                'description' => 'User can view detail a Post',
                'group_id' => $groupId->group_id
            ],
            [
                'name' => 'canCreatePost',
                'description' => 'User can create a Post',
                'group_id' => $groupId->group_id
            ],
            [
                'name' => 'canUpdatePost',
                'description' => 'User can update any Post',
                'group_id' => $groupId->group_id
            ],
            [
                'name' => 'canUpdateOwnPost',
                'description' => 'User can update owner Post',
                'group_id' => $groupId->group_id
            ],
            [
                'name' => 'canRemovePost',
                'description' => 'User can remove Post',
                'group_id' => $groupId->group_id
            ],
        ];

        foreach ($permissionPost as $permission) {
            \Modules\core\models\Permission::create($permission);
        }
    }
}
