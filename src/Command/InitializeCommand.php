<?php


namespace App\Command;

use App\Entity\DataCenter;
use App\Entity\Distribution;
use App\Repository\DataCenterRepository;
use App\Repository\DistributionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitializeCommand extends Command
{
    protected static $defaultName = 'app:init';

    /**
     * @var DataCenterRepository
     */
    private $dataCenterRepository;

    /**
     * @var DistributionRepository
     */
    private $distributionRepository;

    /**
     * @var EntityManagerInterface
     */
    private $manager;


    public function __construct(
        DataCenterRepository $dataCenterRepository,
        DistributionRepository $distributionRepository,
        EntityManagerInterface $manager
    ) {
        parent::__construct();

        $this->dataCenterRepository = $dataCenterRepository;
        $this->distributionRepository = $distributionRepository;
        $this->manager = $manager;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->loadDataCenters($output);
        $this->loadDistributions($output);

        return Command::SUCCESS;
    }

    private function loadDataCenters(OutputInterface $output)
    {
        $output->writeln('<fg=cyan;options=bold>Loading data centers:</>');

        $data = [
            'New York'      => 'NY',
            'San Francisco' => 'SF',
            'Amsterdam'     => 'AM',
            'Singapore'     => 'SI',
            'London'        => 'LO',
            'Frankfurt'     => 'FR',
            'Toronto'       => 'TO',
            'Bangalore'     => 'BA',
        ];

        foreach ($data as $name => $code) {
            $output->write("$name ... ");

            $dataCenter = $this->dataCenterRepository->findOneByCode($code);
            if ($dataCenter) {
                $output->writeln("<comment>exists</comment>");

                continue;
            }

            $dataCenter = new DataCenter();
            $dataCenter
                ->setName($name)
                ->setCode($code);

            $this->manager->persist($dataCenter);

            $output->writeln("<comment>created</comment>");
        }

        $this->manager->flush();
    }

    private function loadDistributions(OutputInterface $output)
    {
        $output->writeln('<fg=cyan;options=bold>Loading distributions:</>');

        $data = [
            'Ubuntu 20.04 (LTS) x64' => 'Ubuntu',
            'FreeBSD 12.2 x64'       => 'FreeBSD',
            'Fedora 34 x64'          => 'Fedora',
            'Debian 10 x64'          => 'Debian',
            'CentOS 8.3 x64'         => 'CentOS',
        ];

        foreach ($data as $name => $code) {
            $output->write("$name ... ");

            $distribution = $this->distributionRepository->findOneByCode($code);
            if ($distribution) {
                $output->writeln("<comment>exists</comment>");

                continue;
            }

            $distribution = new Distribution();
            $distribution
                ->setName($name)
                ->setCode($code);

            $this->manager->persist($distribution);

            $output->writeln("<comment>created</comment>");
        }

        $this->manager->flush();
    }
}
