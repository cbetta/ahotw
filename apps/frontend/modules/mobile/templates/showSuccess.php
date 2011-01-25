<!-- Start of first page -->
<div data-role="page" id="show">

	<div data-role="header" data-theme='b'>
		<h1><?php echo $object->getName() ?></h1>
	</div>

	<div data-role="content">	
		<div class='overflow'>
			<h3><?php echo $object->getOrigin().", ".$object->getDate() ?></h3>
			<h4><a href="<?php echo url_for('@map?location='.$object->getFloor()); ?>" data-rel="dialog" data-transition="slideup">
				<?php echo $object->getFloor().", ".$object->getRoom() ?>
			</a></h4>
			
			<p>
				<object type="application/x-shockwave-flash" id="audioplayer1" data="/flash/player.swf?soundFile=<?php echo urlencode($object->getAudioLink()); ?>&amp;playerID=1" width="290" height="24"> 
				<param name="movie" value="/flash/player.swf?soundFile=<?php echo $object->getAudioLink(); ?>"> 
				<param name="quality" value="high"> 
				<param name="menu" value="false"> 
				<param name="wmode" value="transparent"> 
				<audio src="<?php echo $object->getAudioLink(); ?>" controls preload='none'>Play</audio>

				</object>
			</p>
			
			<img src='<?php echo $object->getImgLink() ?>' class='left' /> 
			<p><?php echo $object->getDescription() ?></p>
		</div>
		<ul data-role="listview" data-theme="c" data-inset="true">
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


