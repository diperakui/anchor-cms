<?php namespace System;

use PDO, System\Database\Connection;

class Database {

	private static $connections = array();

	public static function connection($connection = null) {
		if(is_null($connection)) $connection = Config::get('database.default');

		if( ! isset(static::$connections[$connection])) {
			$config = Config::get("database.connections.{$connection}");

			if(is_null($config)) {
				throw new \Exception("Database connection is not defined for [$connection].");
			}

			static::$connections[$connection] = new Connection(static::connect($config), $config);
		}

		return static::$connections[$connection];
	}

	public static function connect($config) {
		// build dns string
		$dsn = $config['driver'] . ':dbname=' . $config['database'] . ';host=' . $config['hostname'];

		return new PDO($dsn, $config['username'], $config['password']);
	}

	public static function __callStatic($method, $parameters) {
		return call_user_func_array(array(static::connection(), $method), $parameters);
	}

}