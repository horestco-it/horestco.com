<?php

ini_set("display_errors", 1);
require 'api/check_session.php';
require '../classes/DB.php';
require '../classes/Helper.php';
require '../config.php';

use Horestco\My\Model as Model;

$html = render_template('partials/header.php');

////////////
// Detail //
////////////
if (isset($_GET['detail']))
{
	$customer = Model\Customer::find($_GET['id']);

	$html .= render_template('partials/customer/detail.php', compact('customer'));
}
//////////
// list //
//////////
else
{
	$customers = Model\Customer::orderBy('created_at', 'desc')->get();

	$html .= render_template('partials/customer/list.php', compact('customers'));
}

$html .= render_template('partials/footer.php');

echo $html;

