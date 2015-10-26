<?php
/**
 * The mainly handle the method that is always used  
 */
class ArrayHelper{
    public static function string2array($tags)
	{
		/*
		array preg_split ( string $pattern , string $subject [, int $limit = -1 [, int $flags = 0 ]] )
			
			pattern
			The pattern to search for, as a string.
			
			subject
			The input string.
			
			limit
			If specified, then only substrings up to limit are returned with the rest of the string being placed in the last substring. A limit of -1, 0 or NULL means "no limit" and, as is standard across PHP, you can use NULL to skip to the flags parameter.

			PREG_SPLIT_NO_EMPTY
			If this flag is set, only non-empty pieces will be returned by preg_split().
		*/
		return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
	}

	public static function array2string($tags)
	{
		return implode(', ',$tags);
	}
}

?>