<?php

namespace Webleit\DeleteSlackFiles\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Helper\ProgressBar;

use GuzzleHttp\Client;

/**
 * Class DeleteFilesCommand
 * @package Webleit\DeleteSlackFiles\Command
 */
class DeleteFilesCommand extends Command
{
    /**
     * @var string
     */
    protected $token = '';

    /**
     * Configure the command
     */
    protected function configure()
    {
        $this->setName("slack:deletefiles")
                ->setDescription("Delete a list of files from your slack")
                ->addArgument('days', InputArgument::REQUIRED, 'Delete files older than X days')
                ->addOption('token', 't', InputOption::VALUE_REQUIRED,'Slack Token to use');
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->token = $input->getOption('token');


        $days = $input->getArgument('days');

        $client = new Client([
            'base_uri' => 'https://slack.com/api/',
        ]);

        $response = $client->get('files.list', [
            'query' => [
                'ts_to' => time() - $days * 24 * 60 * 60,
                'token' => $this->token,
                'count' => 1000
            ]
        ]);

        $result = json_decode((string)$response->getBody());

        // create a new progress bar (50 units)
        $progress = new ProgressBar($output, count($result->files));

        // start and displays the progress bar
        $progress->start();

        foreach ($result->files as $file) {
            // ... do some work
            $client->post('files.delete', [
                'form_params' => [
                    'token' => $this->token,
                    'file' => $file->id
                ]
            ]);

            // advance the progress bar 1 unit
            $progress->advance();
        }

        // ensure that the progress bar is at 100%
        $progress->finish();

        $output->writeln('');
        $output->writeln('Number of files deleted: ' . count($result->files));
    }

}