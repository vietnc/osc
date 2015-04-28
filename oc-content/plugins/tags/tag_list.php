<?php if( isset($tagList) && !empty($tagList) ) {
    ?>
<?php
$tags_style = osc_get_preference('StyleCss', 'tags');
if ($tags_style=='on') {
?>
<div><br/>
   <?php 
   	foreach($tagList as $tag=>$num) {
            if(is_numeric($tag)) continue;
            echo "<a class='tag' href='".osc_base_url(false)."tim-khuyen-mai/tags,".$tag."'>".$tag ."</a> (".$num.")"  ;
  } ?>
</div>
<?php } else if ($tags_style=='off') { ?>
<div><br/>
   <?php 
  	foreach($tagList as $tag=>$num) {
            if(is_numeric($tag)) continue;
            echo "&#8226; <a href='".osc_base_url(false)."tim-khuyen-mai/tags,".$tag."'>".$tag ."</a> (".$num.")"  ;
  } ?>
</div>

<?php } }?>

