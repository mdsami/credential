<?php

function btn_edit ($uri)
{
	return anchor($uri, '<i class="fa fa-edit"></i>');
}

function btn_delete ($uri)
{
	return anchor($uri, '<i class="fa fa-remove"></i>', array(
		'onclick' => "return confirm('You are about to delete a record. This cannot be undone. Are you sure?');"
	));
}
