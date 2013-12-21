{php}

	$user = $this->_tpl_vars['clientsdetails'];

	$preauth_query = select_query('mod_gocardless_client_preauth','preauth_id', array('client_id' => $user['userid'], 'active' => 1));//$user['id']));
	// check for a preauth:
	$preauth = mysql_fetch_assoc($preauth_query);
	$preauthID = isset($preauth['preauth_id']) ? $preauth['preauth_id'] : false;

	if($preauthID != false) // preauth exists
	{

	}
	else // we need to create a preauth
	{
		$preauthExists = false;
		$pre_auth_maximum = 5000; // CCF: Always create a £5000 pre-auth (and we can take it every day if we really want to
		# Button title
		$title = 'Create Direct Debit Subscription';
		$gcUser = array(
			'first_name'        => $user['firstname'],
			'last_name'         => $user['lastname'],
			'email'             => $user['email'],
			'billing_address1'  => $user['address1'],
			'billing_address2'  => $user['address2'],
			'billing_town'      => $user['city'],
			'billing_county'    => $user['state'],
			'billing_postcode'  => $user['postcode'],
		);
		# create GoCardless preauth URL using the GoCardless library
				$url = GoCardless::new_pre_authorization_url(array(
					'max_amount' => $pre_auth_maximum,
					# set the setup fee as the first payment amount - recurring amount
					'setup_fee' => 0,
					'name' => "Variable invoice subscription",
					// CCF: override the length and period to allow payments every day
					'interval_length' => 1,
					'interval_unit' => 'day',
					'start_at' => date_format(date(),'Y-m-d\TH:i:sO'),
					'user' => $aUser,
		));
	}

{/php}

<h1>{$pagetitle}</h1>
{php}if (isset($_GET['success']) && $_GET['success'] == 1) :{/php}
<div class="success-box">
	Direct Debit subscription has been completed successfully
</div>
{php}elseif (isset($_GET['success']) && $_GET['success'] == 0) :{/php}
<div class="error-box">
	Direct Debit subscription failed, please try again
</div>
{php}endif;{/php}
<p>&nbsp;</p>


{php}if ($preauthID == false) :{/php}
	<a class="btn orange pull-right" onclick="window.location='{php}echo $url;{/php}';" href="{php}echo $url;{/php}">Set up your Direct Debit</a>
<p>We have teamed up with GoCardless to offer convenient Direct Debit payments for you.</p>
	<p>Please click the orange button to the right and set up your preauthorisation.</p>

{php}else :{/php}
<p>We have teamed up with GoCardless to offer convenient Direct Debit payments for you.</p>
	<p>Your preauthorisation is already active, your invoices will be automatically paid using this method.</p>
	<p>If you wish to cancel your preauthorisation, please head to <a href="http://gocardless.com" target="_blank">GoCardless</a> and cancel it from there.</p>

{php}endif;{/php}

<p>Payments will only ever be collected in line with invoices raised and their respective due date.</p>
<p>You will be notified by email prior to your account being debited.</p>


