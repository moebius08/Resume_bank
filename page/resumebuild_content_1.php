<?php 

$resume['contact'] = str_replace('\\',"",$resume['contact']);
$resume['skills'] = str_replace('\\',"",$resume['skills']);
$resume['works'] = str_replace('\\',"",$resume['experience']);
$resume['education'] = str_replace('\\',"",$resume['education']);
$resume['certificates'] = str_replace('\\',"",$resume['certificates']);

$contact = json_decode($resume['contact']);
$skills = json_decode($resume['skills']);
$works = json_decode($resume['experience']);
$education = json_decode($resume['education']);
$certificates = json_decode($resume['certificates']);





?>





<!DOCTYPE html>
 <html>
 <head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title><?=$title?></title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/2.7.0/build/reset-fonts-grids/reset-fonts-grids.css" media="all" /> 
   <link rel='stylesheet' href="<?=$action->helper->loadcss('resumebuild_content_1.css')?>">

   <style>
	html{
    margin: 0;
    padding: 0;
}
           
        </style>
 </head>
 <body>


<div id="doc2" class="yui-t7">
	<div id="inner">
	
		<div id="hd">
			<div class="yui-gc">
				<div class="yui-u first">
					<h1><?=@$resume['name']?></h1>
					<h2><?=@$resume['headline']?></h2>
				</div>

				<div class="yui-u">
					<div class="contact-info">
						<h3><a id="pdf" href="#"><?=@$contact->mobile?></a></h3>
						<h3><a href="mailto:<?=@$contact->email?>"><?=@$contact->email?></a></h3>
						<h3><?=@$contact->address?></h3>
					</div><!--// .contact-info -->
				</div>
			</div><!--// .yui-gc -->
		</div><!--// hd -->

		<div id="bd">
			<div id="yui-main">
				<div class="yui-b">

					<div class="yui-gf">
						<div class="yui-u first">
							<h2>Objective</h2>
						</div>
						<div class="yui-u">
							<p class="enlarge">
							<?=@$resume['objective']?>				
						</p>
						</div>
					</div><!--// .yui-gf -->

					<div class="yui-gf">
						<div class="yui-u first">
							<h2>Skills</h2>
						</div>
						<div class="yui-u">

						
								<?php 
								foreach($skills as $skill) {
									?>

									<ul class="talent">
										<li><?=$skill?></li>
									</ul>

									<?php 
								}
								?>
							
						</div>
					</div><!--// .yui-gf-->

					<div class="yui-gf">
	
						<div class="yui-u first">
							<h2>Experience</h2>
						</div><!--// .yui-u -->

						<div class="yui-u">

						<?php 
								if(count($works)<1) {
									?>
									<div class="job last">

									<h3>Fresher</h3>

									</div>

									<?php 
								}
								?>

						<?php 
								foreach($works as $work) {
									?>
								<div class="job">
								<h2><?=$work->company?></h2>
								<h3><?=$work->jobrole?></h3>
								<h4><?=$work->w_duration?></h4>
								<p> <?=$work->work_desc?> </p>
								</div>
									
									<?php 
								}
								?>

						</div><!--// .yui-u -->
					</div><!--// .yui-gf -->
					<?php 
								if (isset($certificates) && is_array($certificates) && count($certificates) > 0) {
									?>
					
					<div class="yui-gf">
	
						<div class="yui-u first">
							<h2>Certifications</h2>
						</div><!--// .yui-u -->

						<div class="yui-u">

						<?php 
								foreach($certificates as $certificate) {
									?>
								<div class="job">
								<h2><?=$certificate->title?></h2>
								<h3><?=$certificate->date?></h3>
								</div>
									
									<?php 
								}
								?>

						</div><!--// .yui-u -->
					</div><!--// .yui-gf -->
					<?php 
								}
								?>


					<div class="yui-gf last">
						<div class="yui-u first">
							<h2>Education</h2>
						</div>

						<?php 
								if(count($education)<1) {
									?>
									<div class="yui-u">

									<h3>No Education</h3>

									</div>

									<?php 
								}
								?>


						<?php 
								foreach($education as $educ) {
									?>
								<div class="yui-u" style="padding:10px 0px;border-bottom:1px solid rgba(0,0,0,0.2)">
							<h2><?=$educ->college?></h2>
							<h3><?=$educ->course?> &mdash; <strong>( <?=$educ->e_duration?> )</strong> </h3>
							</div>
									<?php 
								}
								?>


				</div><!--// .yui-b -->
			</div><!--// yui-main -->
		</div><!--// bd -->

		<div id="ft">
			<p><?=@$resume['name']?> &mdash; <a href="mailto:<?=@$contact->email?>"><?=@$contact->email?></a> &mdash; <?=@$contact->mobile?></p>
		</div><!--// footer -->

	</div><!-- // inner -->


</div><!--// doc -->