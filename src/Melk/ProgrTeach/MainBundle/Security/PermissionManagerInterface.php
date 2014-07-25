<?php
/**
 * Created by PhpStorm.
 * User: melk
 * Date: 25.07.14
 * Time: 10:20
 */

namespace Melk\ProgrTeach\MainBundle\Security;

interface PermissionManagerInterface {

    /**
     * Synchronize permissions with database. Add new, update existings and remove not used.
     */
    public function syncDatabase();

}