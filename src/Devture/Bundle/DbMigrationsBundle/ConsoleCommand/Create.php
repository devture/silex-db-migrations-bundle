<?php
namespace Devture\Bundle\DbMigrationsBundle\ConsoleCommand;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Phinx\Console\Command\Create as PhinxCreate;
use Devture\Bundle\DbMigrationsBundle\Config\Config;

class Create extends PhinxCreate {

	protected $configOptions;

	public function __construct($name = null, $configOptions = null) {
		parent::__construct($name);

		$this->configOptions = $configOptions;
	}

	protected function loadConfig(InputInterface $input, OutputInterface $output) {
		$config = Config::loadConfig($this->configOptions);

		$this->setConfig($config);
	}

	protected function configure() {
		parent::configure();

		$this->setName('migrations:create');
	}

}
