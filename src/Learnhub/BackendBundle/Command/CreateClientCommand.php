<?php
namespace BackendBundle\Command;

use BackendBundle\Entity\Client;
use BackendBundle\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class CreateClientCommand extends Command {
    protected function configure()
    {
        $this
            ->setName('learnhub:client-create')
            ->setDescription('Create a new client')
            ->addArgument('name', InputArgument::REQUIRED, 'Sets the client name', null)
            ->addArgument('userId', InputArgument::OPTIONAL, 'Sets the client user', null)
            ->addOption('redirect-uri', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Sets redirect uri for client. Use this option multiple times to set multiple redirect URIs.', null)
            ->addOption('grant-type', null, InputOption::VALUE_REQUIRED | InputOption::VALUE_IS_ARRAY, 'Sets allowed grant type for client. Use this option multiple times to set multiple grant types.', null)
        ;
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /** @var $container ContainerInterface*/
        $container = $this->getApplication()->getKernel()->getContainer();
        $clientManager = $container->get('fos_oauth_server.client_manager.default');

        /** @var $client Client*/
        $client = $clientManager->createClient();
        $client->setName($input->getArgument('name'));

        if ($input->getArgument('userId')) {
            $em = $container->get('doctrine.orm.default_entity_manager');
            $repository = $em->getRepository('BackendBundle:User');
            $user = $repository->findOneBy(['id'=>$input->getArgument('userId')]);

            if ($user instanceof User) {
                $client->setUser($user);
            }
        }

        $client->setRedirectUris($input->getOption('redirect-uri'));
        $client->setAllowedGrantTypes($input->getOption('grant-type'));
        $clientManager->updateClient($client);
        $output->writeln(sprintf('Added a new client with name <info>%s</info> and public id <info>%s</info>.', $client->getName(), $client->getPublicId()));
    }
}