<?php
namespace Devture\Bundle\DbMigrationsBundle;

class ServicesProvider implements \Pimple\ServiceProviderInterface, \Silex\Api\BootableProviderInterface {

	private $config;

	public function __construct(array $config) {
		$this->config = $config;
	}

	public function register(\Pimple\Container $container) {
		$config = $this->config;

		$container['devture_db_migration.console_command.create'] = function () use ($config) {
			return new ConsoleCommand\Create(null, $config);
		};

		$container['devture_db_migration.console_command.migrate'] = function () use ($config) {
			return new ConsoleCommand\Migrate(null, $config);
		};

		$container['devture_db_migration.console_command.rollback'] = function () use ($config) {
			return new ConsoleCommand\Rollback(null, $config);
		};

		$container['devture_db_migration.console_command.status'] = function () use ($config) {
			return new ConsoleCommand\Status(null, $config);
		};

		$container['devture_db_migration.console_command.test'] = function () use ($config) {
			return new ConsoleCommand\Test(null, $config);
		};
	}

	public function boot(\Silex\Application $app) {
		if (isset($app['console'])) {
			$app['console']->add($app['devture_db_migration.console_command.create']);
			$app['console']->add($app['devture_db_migration.console_command.migrate']);
			$app['console']->add($app['devture_db_migration.console_command.rollback']);
			$app['console']->add($app['devture_db_migration.console_command.status']);
			$app['console']->add($app['devture_db_migration.console_command.test']);
		}
	}

}
