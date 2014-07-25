<?php
/**
 * Created by PhpStorm.
 * User: melk
 * Date: 25.07.14
 * Time: 10:07
 */

namespace Melk\ProgrTeach\MainBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Melk\ProgrTeach\MainBundle\Security\PermissionManagerInterface;

class SyncPermissionsCommand extends ContainerAwareCommand{

    /**
     * Permission manager for sycn
     * @var PermissionManagerInterface
     */
    private $permissionManager;

    public function __construct(PermissionManagerInterface $permissionManager, $name = null) {
        parent::__construct($name);
        $this->permissionManager = $permissionManager;
    }

    protected function configure() {
        $this
            ->setName('melk:sync:permission')
            ->setDescription('Synchronizes permissions from config file with database')
            ->setHelp('This command moves permissions from config file to database. All permissions in DB which are not present in config file will be removed.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $output->writeln('Starting synchronization');

        $this->permissionManager->syncDatabase();

        $output->writeln('Synchronization completed');
    }

}
