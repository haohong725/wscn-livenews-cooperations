<?php
namespace components;

class LivenewsHanlder
{
	public static $instance;
	public static $db;

	public function __construct()
	{
		self::$db = MySQLi::getInstance();
	}

	static function getInstance()
	{
		if (self::$instance) {
			return self::$instance;
		} else {
			return self::$instance = new self;
		}
	}

	static function createOrUpdate($item)
	{
		$saved = self::findById($item['id']);
		if ($saved) {
			if ($item['updatedAt'] > $saved['updatedAt']) {
				self::delete($item);
				self::create($item);
			}
		} else {
			self::create($item);
		}
	}

	static function findById($id)
	{
		$selectSql = "SELECT * FROM livenews WHERE id = $id LIMIT 1";
		$item = self::$db->getLine($selectSql);

		return $item;
	}

	static function delete($item)
	{
		$id = $item['id'];
		$deleteSql = "DELETE FROM livenews WHERE id = $id LIMIT 1";

		self::$db->query($deleteSql);
		echo "delete livenews : ".$id."\n";
	}

	static function create($item)
	{
		$columns = '';
		$values = '';

		foreach ($item as $k => $v) {
			$tmp = empty($columns) ? $k : ','.$k;
			$columns .= $tmp;

			$tmp = empty($values) ? "'$v'" : ','."'$v'";
			$values .= $tmp;
		}

		$insertSql = <<<SQL
INSERT INTO livenews ($columns) VALUES ($values);
SQL;

		/**
		 * @var $db MySQLi
		 */
		self::$db->query($insertSql);

		$id = $item['id'];
		echo "create livenews : ".$id."\n";
	}
}
