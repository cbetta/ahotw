<!-- Start of first page -->
<div data-role="page" id="show">

	<div data-role="header">
		<h1><?php echo $object->getName() ?></h1>
	</div>

	<div data-role="content">	
		<div class='overflow'>
			<h3><?php echo $object->getOrigin().", ".$object->getDate() ?></h3>
			<h4><a href="<?php echo url_for('@map?location='.$object->getFloor()); ?>" data-rel="dialog" data-transition="slideup">
				<?php echo $object->getFloor().", ".$object->getRoom() ?>
			</a></h4>
			<img src='<?php echo $object->getImgLink() ?>' class='left' /> 
			<p><?php echo $object->getDescription() ?></p>
		</div>
		<ul data-role="listview" data-theme="c" data-inset="true">
				<li>
					<h4><a href='<?php echo $object->getAudioLink(); ?>'>
						Podcast Episode #<?php echo $object->getNumber(); ?>
					</a></h4>				
				</li>
				<li>
					<h4><a href='<?php echo url_for('@mobile_transcript?number='.$object->getNumber()) ?>'>
					  Podcast Transcript
					</a></h4>				
				</li>
				<?php if ($object->getBbcLink() != '') : ?>
				<li>
					<h4><a href='<?php echo $object->getBbcLink() ?>'>
					  BBC Page
					</a></h4>				
				</li>
				<?php endif; ?>
				<?php if ($object->getBmLink() != '') : ?>
				<li>
					<h4><a href='<?php echo $object->getBmLink() ?>'>
					  British Museum Page
					</a></h4>				
				</li>
				<?php endif; ?>
				<?php if ($object->getWpLink() != '') : ?>
				<li>
					<h4><a href='<?php echo $object->getWpLink() ?>'>
					  Wikipedia Page
					</a></h4>				
				</li>
				<?php endif; ?>
		</ol>
	</div>
	


</div>


