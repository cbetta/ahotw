<!-- Start of first page -->
<div data-role="page" id="show">

	<div data-role="header">
		<h1><?php echo $object->getName() ?> : Transcript</h1>
	</div>

	<div data-role="content">	
		<?php echo str_replace('\n', '<br/><br/>', $object->getTranscript()) ?>
	</div>


</div>


