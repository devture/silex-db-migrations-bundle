<?php
namespace Devture\Bundle\DbMigrationsBundle\ConsoleCommand;

use Phinx\Console\Command\Status as PhinxStatus;
use Devture\Bundle\DbMigrationsBundle\Config\Config;

class Status extends PhinxStatus {

	protected $configOptions;

	public function __construct($name = null, $configOptions = null) {
		parent::__construct($name);

		$this->configOptions = $configOptions;
	}

	protected function loadConfig($input, $output) {
		$config = Config::loadConfig($this->configOptions);

		$this->setConfig($config);
	}

	protected function configure() {
		parent::configure();

		$this->setName('migrations:status');
	}

}
