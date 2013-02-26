<?php

class analytics
{
	function __construct($db)
	{
		$this->db = $db;
	}

	function insertUAString($string)
	{
		$stmt = $this->db->prepare("INSERT INTO `analytics` (uastring, time) VALUES (?, NOW())");
		$stmt->bind_param("s", $string);
		$stmt->execute();
		$stmt->close();
	}
}