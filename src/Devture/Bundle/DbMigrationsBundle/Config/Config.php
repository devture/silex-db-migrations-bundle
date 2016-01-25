<?php
namespace Devture\Bundle\DbMigrationsBundle\Config;

use Phinx\Config\Config as PhinxConfig;

class Config extends PhinxConfig {
	/**
	 * Create a new instance of the config class using a PHP array.
	 *
	 * @param  array $configArray
	 * @throws \RuntimeException
	 * @return Config
	 */
	public static function fromArray(array $configArray, $appBasePath) {
		return new static($configArray, $appBasePath);
	}

	/**
	 * Loads the configuration.
	 *
	 * @param array $configOptions
	 * @return Config
	 */
	public static function loadConfig(array $configOptions) {
		$configArr = $configOptions;
		foreach($configArr['environments'] as $environment => $environmentData){
			if(!is_array($environmentData)) {
				continue;
			}

			//If no URI is specified for an environment, consider that environment disabled.
			if ($configArr['environments'][$environment]['uri'] === null) {
				unset($configArr['environments'][$environment]);
				continue;
			}

			$matches = null;
			if (!preg_match('/^([^:]+):([^@]+)@([^\/]+)\/(.+?)$/', $configArr['environments'][$environment]['uri'], $matches)) {
				throw new \Exception('Cannot parse database URI.');
			}
			list ($_fullMatch, $dbUsername, $dbPassword, $dbHost, $dbName) = $matches;

			$configArr['environments'][$environment]['name'] = $dbName;
			$configArr['environments'][$environment]['host'] = $dbHost;
			$configArr['environments'][$environment]['user'] = $dbUsername;
			$configArr['environments'][$environment]['pass'] = $dbPassword;

			unset($configArr['environments'][$environment]['uri']);

		}
		unset($configArr['migrations_base_path']);

		return self::fromArray($configArr, $configOptions['migrations_base_path']);
	}

}
