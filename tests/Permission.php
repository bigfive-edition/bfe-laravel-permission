<?php

namespace Bfe\Permission\Test;

class Permission extends \Bfe\Permission\Models\Permission
{
    protected $primaryKey = 'permission_test_id';

    protected $visible = [
      'permission_test_id',
      'name',
    ];
}
