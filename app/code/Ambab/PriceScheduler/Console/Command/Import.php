<?php
namespace Ambab\PriceScheduler\Console\Command;
 
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Ambab\PriceScheduler\Model\ProductUploader;
use Ambab\PriceScheduler\Helper\Data; 

class Import extends Command
{    
    /**
     * @var Ambab\PriceScheduler\Model\ProductUploader
     */
    protected $productupload;
    public function __construct(Data $helper)
    {
        $this->helper = $helper;
        parent::__construct();
    }
    protected function configure()
   {
       $this->setName('ambab:pricescheduler');
       $this->setDescription('Export product data');
       
       parent::configure();
   }
   protected function execute(InputInterface $input, OutputInterface $output)
   {
       $output->writeln(sprintf('<comment>Processing...</comment>'));
       $this->helper->Uploader();
       $output->writeln(sprintf('<comment>Done</comment>'));
   }
}