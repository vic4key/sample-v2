<?php
	define("next_line", "\n\t");

	foreach ($GLOBALS["views"]["styles"] as $file)
	{
		echo "<script type=\"text/javascript\">incl_style(\"$file\");</script>".next_line;
	}

	foreach ($GLOBALS["views"]["scripts"] as $file)
	{
		echo "<script type=\"text/javascript\" src=\"$file\"></script>".next_line;
	}
?>