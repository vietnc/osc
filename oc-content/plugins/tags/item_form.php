<?php $UserMaxWord = getMaxUserTags(); ?>
<h2><?php _e('Tags', 'tags'); ?></h2>
<div class="meta_list">
    <div style="padding-right:22px;" align="center" class="meta">
        <?php _e( 'Enter tags for better search results. Each tag separated by comma, last tag without comma:', 'tags' ) ; ?><?php echo "<br/>(<strong>Max. <span style='color:#F00;'>".$UserMaxWord."</span></strong>)"; ?>&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="s_tags" id="s_tags" value="<?php echo $detail['tags'] ; ?>" />
    </div>
    <hr/>
</div>
<script type="text/javascript"><!--
    function check_words(e) {
  var BACKSPACE   = 8;
  var DELETE      = 46;
  var MAX_WORDS   = <?php echo $UserMaxWord ; ?>;
  var valid_keys  = [BACKSPACE, DELETE];
  var words       = this.value.split(',');
  
  
  if (words.length > MAX_WORDS && valid_keys.indexOf(e.keyCode) == -1) {
	  alert('<?php echo sprintf(__('You cannot put more than %s tags in this field.','tags'),$UserMaxWord); ?>');
	  e.preventDefault();
      words.length = MAX_WORDS;
      this.value = words.join(',');
  }
}

var textarea = document.getElementById('s_tags');
textarea.addEventListener('keydown', check_words);
textarea.addEventListener('keyup', check_words);
textarea.addEventListener('change', check_words);
textarea.addEventListener('click', check_words);
   
   //--></script>
