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

class SyncPermissionsCommand extends ContainerAwareCommand{

    protected function configure() {
        $this
            ->setName('melk:sync:permission')
            ->setDescription('Synchronizes permissions from config file with database')
            ->setHelp('This command moves permissions from config file to database. All permissions in DB which are not present in config file will be removed.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $permManager = $this->getContainer()->get('melk.progr.permission.manager');
        $output->writeln('Starting synchronization');

        $permManager->syncDatabase();

        $output->writeln('Synchronization completed');
    }

}
