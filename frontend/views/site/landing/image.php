<?php
$detect = new \Mobile_Detect();
if($detect->isMobile()):
?>
<img src="<?=$landing->valuemobile?>" alt="landingpage" title="landingpage">
<?php else:?>
<img src="<?=$landing->value?>" alt="landingpage" title="landingpage">
<?php endif;?>