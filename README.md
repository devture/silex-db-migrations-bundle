# DB Migrations Bundle

Silex bundle that provides DB migrations (powered by Phinx).


## Configuration

	"DbMigrationsBundle": {
		"environments": {
			"default_database"	:	"development",
			"development": {
				"adapter"	:	"%DATABASE_ADAPTER%",
				"charset"	:	"%DATABASE_CHARSET%",
				"collation"	:	"%DATABASE_COLLATION%",
				"uri"		:	"%DATABASE_URI%"
			}
		},
		"paths": {
			"migrations": "migrations"
		},
		"migrations_base_path": "%app_base_path%"
	}

Example parameters:

	{
		"DATABASE_ADAPTER": "mysql",
		"DATABASE_CHARSET": "utf8",
		"DATABASE_COLLATION": "utf8_general_ci",
		"DATABASE_URI": "username:password@localhost/db_name",
	}


## Initializing

	$app->register(new \Devture\Bundle\DbMigrationsBundle\ServicesProvider($app['config']['DbMigrationsBundle']));


## Usage

As configured above, a `migrations/` directory needs to exist in the main project directory (`%app_base_path%`).

The bundle would attach some additional console commands to the `$app['console']` service.
