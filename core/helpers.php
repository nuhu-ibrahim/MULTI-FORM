<?php

function view($name, $data = [])
{
    extract($data);

    return require "resources/views/{$name}.view.php";
}

function redirect($path)
{
    header("Location: /{$path}");
}

function get_directory($filename, $folder_ind, $tab_count)
{
	$first = true;
	$directory = "";
	for($i = 0; $i < $tab_count; $i++){
		if($first){
			$first = false;
			$directory .= $folder_ind[$i];
			continue;
		}

		$directory .= "\\" . $folder_ind[$i];
	}

	return $directory;
}

function get_number_of_tabs($name)
{
	$chars = str_split($name);

	$num = 0;
	foreach($chars as $char){
		if($char != ' ')
			break;
		$num++;
	}

	return $num;
}

function dd($data)
{
	print_r("<pre>");
	print_r($data);
	print_r("</pre>");
}

function gwd()
{
	return getcwd()."/storage";
}

function convert_to_object($array, $object)
{
	foreach ($array as $k=> $v) {
        $object->{$k} = $v;
    }

    return $object;
}
