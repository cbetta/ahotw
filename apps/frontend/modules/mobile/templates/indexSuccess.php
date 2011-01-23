<!-- Start of first page -->
<div data-role="page" id="index">

	<div data-role="header">
		<h1>AHOTW Mobile</h1>
	</div>

	<div data-role="content">	
		<ol data-role="listview" data-theme="c" data-filter='true'>
			<?php foreach($objects as $object) : ?>
				<li>
					<img src='/objects/<?php echo $object->getNumber() ?>.jpg' />
					<h4><a href='<?php echo url_for('@mobile_show?number='.$object->getNumber()) ?>'><?php echo $object->getName() ?></a></h4>
					<p><strong><?php echo $object->getFloor().", ".$object->getRoom() ?></strong></p>
				
				</li>
			<?php endforeach; ?>
		</ol>
	</div>


</div>


