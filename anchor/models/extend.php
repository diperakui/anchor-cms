<?php

class Extend extends Model {

	public static $table = 'extend';

	public static function paginate($page = 1, $perpage = 10) {
		$query = DB::table(static::$table);

		$count = $query->count();

		$results = $query->take($perpage)->skip(($page - 1) * $perpage)->get();

		return new Paginator($results, $count, $page, $perpage, url('extend'));
	}

}