<!-- Start of first page -->
<div data-role="page" id="index">

	<div data-role="content">	
		<img src='/images/header.png' class='header' />
		<ul data-role="listview" data-theme="c" data-filter='true'>
			<?php foreach($objects as $object) : ?>
				<li>
					<img src='/objects/<?php echo $object->getNumber() ?>.jpg' />
					<h4><?php echo $object->getNumber(); ?>. <a href='<?php echo url_for('@mobile_show?number='.$object->getNumber()) ?>'><?php echo $object->getName() ?></a></h4>
					<p><strong><?php echo $object->getFloor().", ".$object->getRoom() ?></strong></p>
				
				</li>
			<?php endforeach; ?>
		</ul>
	</div>


</div>


