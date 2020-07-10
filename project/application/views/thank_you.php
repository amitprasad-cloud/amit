<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Redskins Training Camp Registration</title>
	<link rel="stylesheet" href="<?=base_url()?>themes/default/css/normalize.css">
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>themes/default/css/main.css">
	<link rel="stylesheet" href="<?=base_url()?>themes/default/css/main.css">
	<script src="<?=base_url()?>themes/default/js/vendor/modernizr-2.8.3.min.js"></script>
	<link rel="stylesheet" href="http://redskinsvalidation.dasdak.com/">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="http://redskinsvalidation.dasdak.com/css/main.css">
	<script src="http://redskinsvalidation.dasdak.com/js/vendor/modernizr-2.8.3.min.js"></script>
	<!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<body class="landing">
	<div class="container-fluid">
		<div class="row">
			<div class="right-panel-container">
				<div class="right-panel">
					<div class="custom-logo">
						<img src="<?=base_url()?>img/default/logo.png" attr="redskins logo">
					</div>
					<div class="player-img">
						<img src="<?=base_url()?>img/default/player-images.png">
					</div>
				</div>
			</div>
			<div class="left-panel-container">
				<div class="left-panel">
					<h4>Bon Secours Training Center, 2401 W Lelgh St, Richmond, VA 23220</h4>
					<h4 class="text-center"><strong>2018 Redskins Training Camp</strong></h4>
					<div class="registration_form">
						<form name="registration" method="post" class="clearfix" >
							<input type="hidden" name="id" value="<?=$id?>">
							<div class="text-center">
								<div class="col-md-12 thank">
                                  <span class="thankyou">THANK YOU FOR SIGNING UP!</span>
								</div>
								<div class="col-md-12 thank">
									<div class="col-md-12">
                                      <span class="gst">GUEST</span>
									</div>
								<?php foreach($usersdata as $user){ ?>
									<div class="col-md-12">
                                        <span class="frname"><?=$user['firstname']?> <?=$user['lastname']?></span>
										<span class="fremail"><?=$user['email']?></span>
									</div>
							    <?php } ?>
							    </div>
							</div>
							<div class="invatation_details">
								<p>Invite your friends and family to the Redskins Training Camp. You are not required to register kids 13 and under - your Fan Mobile Pass will also be valid for their entry.</p>
							</div>
							<div style="margin-left:10%;" class="input_fields_wrap invitee-list form-inline" data-prototype="&#x20;&#x20;&#x20;&#x20;&lt;div&#x20;class&#x3D;&quot;input-field&#x20;clearfix&quot;&gt;&#x0A;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&lt;div&#x20;class&#x3D;&quot;col-md-3&#x20;add&#x20;friend-firstname&quot;&gt;&#x0A;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&lt;input&#x20;type&#x3D;&quot;text&quot;&#x20;id&#x3D;&quot;registration_guests___name___firstName&quot;&#x20;name&#x3D;&quot;registration&#x5B;guests&#x5D;&#x5B;__name__&#x5D;&#x5B;firstName&#x5D;&quot;&#x20;required&#x3D;&quot;required&quot;&#x20;placeholder&#x3D;&quot;First&#x20;Name&quot;&#x20;class&#x3D;&quot;form-control&#x20;form-control&quot;&#x20;&#x2F;&gt;&#x0A;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x0A;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&lt;&#x2F;div&gt;&#x0A;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&lt;div&#x20;class&#x3D;&quot;col-md-3&#x20;add&#x20;friend-lastname&quot;&gt;&#x0A;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&lt;input&#x20;type&#x3D;&quot;text&quot;&#x20;id&#x3D;&quot;registration_guests___name___lastName&quot;&#x20;name&#x3D;&quot;registration&#x5B;guests&#x5D;&#x5B;__name__&#x5D;&#x5B;lastName&#x5D;&quot;&#x20;required&#x3D;&quot;required&quot;&#x20;placeholder&#x3D;&quot;Last&#x20;Name&quot;&#x20;class&#x3D;&quot;form-control&#x20;form-control&quot;&#x20;&#x2F;&gt;&#x0A;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x0A;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&lt;&#x2F;div&gt;&#x0A;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&lt;div&#x20;class&#x3D;&quot;col-md-3&#x20;add&#x20;friend-email&quot;&gt;&#x0A;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&lt;input&#x20;type&#x3D;&quot;email&quot;&#x20;id&#x3D;&quot;registration_guests___name___email&quot;&#x20;name&#x3D;&quot;registration&#x5B;guests&#x5D;&#x5B;__name__&#x5D;&#x5B;email&#x5D;&quot;&#x20;required&#x3D;&quot;required&quot;&#x20;placeholder&#x3D;&quot;Email&quot;&#x20;class&#x3D;&quot;form-control&#x20;form-control&quot;&#x20;&#x2F;&gt;&#x0A;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x0A;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&lt;&#x2F;div&gt;&#x0A;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&#x20;&lt;div&#x20;class&#x3D;&quot;col-md-3&#x20;remove_field&#x20;&quot;&gt;X&lt;&#x2F;div&gt;&#x0A;&#x20;&#x20;&#x20;&#x20;&lt;&#x2F;div&gt;&#x0A;"></div>
							<div class="input-field clearfix text-center">
								<div class="col-md-12">
									<input type="button" name="addfriends" value="+ Add Friends" class="addfriend" id="add-invitee-trigger">
									<input type="submit" name="getregisterd" value="Submit">
								</div>
							</div>
							<div class="hide">
								<div class="form-group">
									<div class="form-group collection-items registration_guests_form_group" data-prototype="" data-prototype-name="__name__" data-prototype-label="__name__label__" id="collectionregistration_guests_form_group"></div>
								</div>
								<input type="hidden" id="registration_step" name="registration[step]" class="form-control" />
								<input type="hidden" id="registration__token" name="registration[_token]" class="form-control" value="qOUNvKFBftIiV4X5u_74FCXOTJZXCK53wfC-3aQzEpc" />
							</div>
						</form>
						<div class="details_reg">
							<p>Entry is first come, first serve. Date of camp are subject to change. See complete schedule and more information at <a href="http://www.redskins.com/trainingcamp" target="_blank">redskins.com/trainingcamp.</a> 
								<br />
								<br />* Please share my email address with NBC Universal, so NBC Universal can send me information about special offer and promotion. I have read and agree to <a href="https://tracking.cirrusinsight.com/6305dab5-367d-4a0f-a674-87d2e81e6e99/nbcuniversal-com-privacy" target="_blank"> NBC UNERVERSAL’S PRIVACY POLICY. </a>
								<br />
								<br />
								<br />
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="add_friend"></div>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.js"></script>
	<script src="<?=base_url()?>themes/default/js/scripts.js"></script>
</body>

</html>