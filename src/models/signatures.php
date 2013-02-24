<?php

class signatures
{
	function __construct($db)
	{
		$this->db = $db;
	}

	function insert($data)
	{
		if(pam_auth($data['uname'], $data['pword']))
		{
			if($stmt = $this->db->prepare("SELECT * FROM `signatures` WHERE uname = ?"))
			{
				$stmt->bind_param("s", $data['uname']);
				$stmt->execute();
				$stmt->store_result();
				$already = $stmt->num_rows;
				var_dump($already);
				$stmt->close();
				if($already == 0)
				{
					$info = ldap_get_info($data['uname']);
					$staff = ($info == "" ? 1 : 0); //This indicates someone without a course, hence staff member.
					
					$stmt = $this->db->prepare("INSERT INTO `signatures` (uname, anon, staff, comments) VALUES (?, ?, ?, ?)");
					$stmt->bind_param("siib", $data['uname'], $data['anon'], $staff, $data['comments']);
					$stmt->execute();
					$affectedrows = $stmt->affected_rows;
					$stmt->close();
					if($affectedrows == 1)
					{
						return array(true);
					}
					else
					{
						//We really shouldn't be here, as we should only be inserting if the username isn't there.
						return array(false, "MySQLi Error...");
					}
				}
				else
				{
					return array(false, "Sorry, you appear to have already signed the petition!");
				}
			}
		}
		else
		{
			return array(false, "Incorrect Username/Password combination");
		}
	}
}