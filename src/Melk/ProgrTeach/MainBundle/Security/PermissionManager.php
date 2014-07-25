<?php
/**
 * Created by PhpStorm.
 * User: melk
 * Date: 25.07.14
 * Time: 09:49
 */

namespace Melk\ProgrTeach\MainBundle\Security;

use Doctrine\ORM\EntityManager;
use Melk\ProgrTeach\MainBundle\Entity\Permission;

class PermissionManager {

    /**
     * Entity manager
     * @var EntityManager
     */
    private $em;

    /**
     * List of permissions
     * @var array
     */
    private $permissions;

    /**
     * Entity class name
     * @var string
     */
    private $entityClass;

    /**
     * Methods for getting information about entities, which depends from Permissions
     * @var array
     */
    private $dependencyMethods;

    /**
     * Class constructor
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em){
        $this->em = $em;
        $this->permissions = [];
        $this->entityClass = Permission::getClassName();
        $this->dependencyMethods = [];
    }

    /**
     * Add permission
     * @param srting $name
     * @param string $label
     * @param array $roles
     */
    public function addPermission($name, $label, $roles) {
        $this->permissions[$name] = [
            'label' => $label,
            'roles' => $roles
        ];
    }

    /**
     * Set entity class
     * @param string $entityClass
     */
    public function setEntityClass($entityClass) {
        $this->entityClass = $entityClass;
    }

    /**
     * Add dependency method
     * @param string $method
     */
    public function addDependency($method) {
        $this->dependencyMethods[] = $method;
    }

    /**
     * Synchronize permissions with database. Add new, update existings and remove not used.
     */
    public function syncDatabase() {
        $entities = $this->em->getRepository($this->entityClass)->findAll();
        $permissionEntities = [];
        foreach ($entities as $entity) {
            $permissionEntities[$entity->getName()] = $entity;
        }

        foreach ($this->permissions as $name => $permission) {
            $entity = (isset($permissionEntities[$name]))? $permissionEntities[$name] : new $this->entityClass();

            $entity->setName($name);
            $entity->setRoles($permission['roles']);
            $entity->setLabel($permission['label']);

            if (isset($permissionEntities[$name])){
                // remove from array to exclude deleting of this entity
                unset($permissionEntities[$name]);
            } else {
                // persist entity
                $this->em->persist($entity);
            }
        }

        // remove unused entities
        foreach ($permissionEntities as $entity) {
            // check if some child has this permissions, and remove them first
            foreach ($this->children as $method) {
                if (!method_exists($entity, $method)){
                    throw new \RuntimeException("Permissions entity class ".$this->entityClass." has no dependencies method ".$method);
                }
                $children = $entity->$method();
                foreach ($children as $child){
                    if (!method_exists($child, 'setPermissions')) {
                        throw new \RuntimeException("Class ".get_class($child)." has no setPermissions method");
                    }
                    $child->setPermissions(null);
                }
            }
            $this->em->remove($entity);
        }

        $this->em->flush();
    }

}