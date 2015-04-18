<?php if( isset($detail['tags']) && !empty($detail['tags']) ) { ?>
<?php
$tags_style = osc_get_preference('StyleCss', 'tags');
if ($tags_style=='on') {
?>
<div><br/>
   <?php 
   $input = $detail['tags'] ;
	$fields = explode(',', $input);
	foreach($fields as $field) {
	echo "<a class='tag' href='".osc_base_url(true)."?page=search&tags=".$field."'>".$field."</a> "  ;
  } ?>
</div>
<?php } else if ($tags_style=='off') { ?>
<div><br/>
   <?php 
   _e('Tags: ','tags');
   $input = $detail['tags'] ;
	$fields = explode(',', $input);
	foreach($fields as $field) {
	echo "&#8226; <a href='".osc_base_url(true)."?page=search&tags=".$field."'>".$field."</a> "  ;
  } ?>
</div>

<?php } }?>

