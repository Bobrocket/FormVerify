<?php

class FormVerify
{
	public function __construct()
	{
	
	}
	
	public function verify($field, $options)
	{
		if (is_array($options))
		{
			$results = array();
			
			if (isset($options["type"]))
			{
				$type = $options["type"];
				//Begin checking types here
				switch ($type)
				{
					case "string":
						$results["type"] = is_string($field);
						break;
						
					case "number":
						$results["type"] = is_numeric($field);
						break;
						
					case "integer":
						$results["type"] = is_int($field);
						break;
				}
			}
			
			if (isset($options["length"]))
			{
				if (strpos($options["length"], "-") !== false)
				{
					$parts = explode("-", $options["length"]);
					$minlength = intval($parts[0]);
					$maxlength = intval($parts[1]);
				}
				else
				{
					$minlength = intval($options["length"]);
					$maxlength = $minlength;
				}
				//Begin length checking here
				$temp = (string) $field;
				if (strlen($temp) >= $minlength && strlen($temp) <= $maxlength) $results["length"] = true;
				else $results["length"] = false;
			}
			
			if (isset($options["types"]))
			{
				if (!is_array($options["types"])) //String delimited by &
				{
					$types = explode("&", $options["types"]);
				}
				else
				{
					$types = $options["types"];
				}
				//Begin character checking here
				$charset = array();
				
				if (in_array("lowercase", $types)) $charset = array_merge($charset, range('a', 'z'));
				if (in_array("uppercase", $types)) $charset = array_merge($charset, range('A', 'Z'));
				if (in_array("number", $types)) $charset = array_merge($charset, range('0', '9'));
				if (in_array("symbol", $types)) $charset = array_merge($charset, explode("s", "!s\"s£s$s%s^s^s&s*s(s)s-s_s=s+s#s~s[s{s]s}s;s:s's@s<s>s,s.s?s/"));
				foreach (str_split($temp) as $char)
				{
					if (!in_array($char, $charset))
					{
						$results["char"] = false;
						break;
					}
				}
				if (!isset($results["char"])) $results["char"] = true;
			}

			return $results;
		}
		else
		{
			echo "You must pass a form field and an array to verify()!";
		}
		return false;
	}
}
?>