<?php
/*
Plugin Name: Tags Plugin
Plugin URI: http://plugins-zone.com/tags
Description: This plugin enables you to show tags in item page.
Version: 1.0.1
Author: cartagena68
Author URI: http://plugins-zone.com
Short Name: tags
Plugin update URI: http://plugins-zone.com/tags
*/

define( 'TAGS_PATH', dirname( __FILE__) . '/' ) ;
define( 'TAGS_TABLE', DB_TABLE_PREFIX . 't_item_tags' ) ;
// Install Plugin
function tags_install() {
    
    $conn = getConnection();
    $conn->autocommit(false);
    try {
        $path = osc_plugin_resource('tags/struct.sql');
        $sql = file_get_contents($path);
        $conn->osc_dbImportSQL($sql);
        $conn->commit();
        } catch (Exception $e) {
        $conn->rollback();
        echo $e->getMessage();
    }
    $conn->autocommit(true);
	osc_set_preference("AdminTags", "sport,motorsport,house,rent",'tags','STRING');
	osc_set_preference("StyleCss", "on",'tags','STRING');
	osc_set_preference("MaxUserTags", "10",'tags','STRING');
	
}
// Uninstall Plugin
function tags_uninstall() {
    $conn = getConnection();
    $conn->autocommit(false);
    try {
        $conn->osc_dbExec('DROP TABLE %st_item_tags', DB_TABLE_PREFIX);
        $conn->commit();
        } catch (Exception $e) {
        $conn->rollback();
        echo $e->getMessage();
    }
    $conn->autocommit(true);
	osc_delete_preference('AdminTags','tags');
	osc_delete_preference('StyleCss','tags');
	osc_delete_preference('MaxUserTags','tags');
	
}

// ADD TAGS TO DATABASE
		// for item_post.php
if( !function_exists( 'tags_form_post' ) ) {
        function tags_form_post($item)  {
            $catID  = $item['fk_i_category_id'];
            $itemID = $item['pk_i_id'];
            $alltags = Params::getParam( 's_tags' ) ;
            if( empty($alltags) )  return false ;
            $conn = DBConnectionClass::newInstance() ;
            $c_db = $conn->getOsclassDb() ;
            $comm = new DBCommandClass( $c_db ) ;
			
            $values = array(
                'fk_i_item_id' => $itemID,
                'tags'    => $alltags
            ) ;
            $comm->insert( TAGS_TABLE, $values ) ;
    }
}
	// for item_edit.php
if( !function_exists( 'tags_form_edit' ) ) {
        function tags_form_edit($item)  {
            $catID  = $item['fk_i_category_id'];
            $itemID = $item['pk_i_id'];
            $alltags = Params::getParam( 's_tags' ) ;
            if( empty($alltags) ) return false ;
            $conn = DBConnectionClass::newInstance() ;
            $c_db = $conn->getOsclassDb() ;
            $comm = new DBCommandClass( $c_db ) ;
			
            $values = array(
                'fk_i_item_id' => $itemID,
                'tags'    => $alltags
            ) ;
            $comm->replace( TAGS_TABLE, $values ) ;
    }
}
	// insert tags from admin given when exist if user don't fill tag field
function insert_admin_tags($item){
	$catID  = $item['fk_i_category_id'];
	$itemID = $item['pk_i_id'];
	$detail = tags_get_row( osc_item_id() ) ;
	if( !empty($detail) )  return false ;
	$description = osc_item_description() ;
		$alltags = tags_extract($description);
if( empty($alltags) ) return false ;
	$conn = DBConnectionClass::newInstance() ;
            $c_db = $conn->getOsclassDb() ;
            $comm = new DBCommandClass( $c_db ) ;
			
            $values = array(
                'fk_i_item_id' => $itemID,
                'tags'    => $alltags
            ) ;
            $comm->insert( TAGS_TABLE, $values ) ;
	
}
 // GET TAG ROW
 function tags_get_row($itemID) {
        $conn = DBConnectionClass::newInstance() ;
        $c_db = $conn->getOsclassDb() ;
        $comm = new DBCommandClass( $c_db ) ;

        $comm->select() ;
        $comm->from( TAGS_TABLE ) ;
        $comm->where( 'fk_i_item_id', $itemID ) ;
        $rs = $comm->get() ;

        if( $rs === false ) {
            return false ;
        }

        if( $rs->numRows() != 1 ) {
            return false ;
        }

        return $detail = $rs->row() ;
    }
		// SHOW IN ITEM DETAIL
    if( !function_exists( 'tags_item_detail' ) ) {
        function tags_item_detail() {
            $detail = tags_get_row( osc_item_id() ) ;
            if( $detail ) {
                require_once( TAGS_PATH . 'item_detail.php' ) ;
            } 
        }
    }
 ///////////////
 // GET TAG LIST @VietNC
 function tags_get_list() {
        //should have cache for tag summary
     
        $conn = DBConnectionClass::newInstance() ;
        $c_db = $conn->getOsclassDb() ;
        $comm = new DBCommandClass( $c_db ) ;

        $rs = $comm->query("SELECT * FROM ".TAGS_TABLE . " limit 100") ;
         if( $rs === false ) {
            return false ;
        }
        if( $rs->numRows === 0  ) {
            return false ;
        }

         $details = $rs->resultArray() ;
         //convert to tagList
         $tagList= array();
         foreach($details as $detail){
            $tags= explode(',', $detail['tags']);
            foreach($tags as $tagName){
                if(!in_array($tagName,  array_keys($tagList))){
                    array_push($tagList, array($tagName =>1));
                }else{
                    $tagList[$tagName] ++;
                }
            }
            
         }
         return $tagList;
    }

    //VietNC listing tag
    if( !function_exists( 'tags_list' ) ) {
        function tags_list() {           
            $tagList = tags_get_list() ;           
            if( $tagList ) {
                require_once( TAGS_PATH . 'tag_list.php' ) ;
            } 
        }
    }
    //////////////
	
 		// DELETE TAGS WHEN ITEM IS DELETED
function delete_tags_item($id) {
$conn   = getConnection();
$conn->osc_dbExec("DELETE FROM %st_item_tags WHERE fk_i_item_id = '%s'",DB_TABLE_PREFIX, $id);
}
		// ADMIN CONFIG MENU
function tags_settings() {
        osc_admin_render_plugin(osc_plugin_path(dirname(__FILE__)) . '/admin.php') ;
    }
	   // FORM FOR ITEM POST
function tags_form($catID = null) {
        $detail = array( 's_tags' => '' ) ;

        require_once( TAGS_PATH . 'item_form.php' ) ;
    }	
	    // FORM FOR ITEM EDIT
	if( !function_exists( 'tags_edit_form' ) ) {
        function tags_edit_form($catID = null, $itemID = null) {
            $detail = array( 's_tags' => '' ) ;
            $row    = tags_get_row( $itemID ) ;
            if( $row ) {
                $detail = $row ;
            }

            require_once( TAGS_PATH . 'item_form.php' ) ;
        }
    }
	
	// FUNCTIONS TO GET PREFERENCES
	
	function getAdminTags() {
    return(osc_get_preference('AdminTags', 'tags')) ;
}

	function getMaxUserTags() {
		return(osc_get_preference('MaxUserTags', 'tags')) ;
		}
		
	

	// FUNCTION TO AUTO EXTRACT TAGS FROM DESCRIPTION
if( !function_exists( 'tags_extract' ) ) {	
	
	function tags_extract($str, $minWordLen = 4, $minWordOccurrences = 1, $asArray = false, $maxWords = 20, $restrict = true)
{
		
    $str = str_replace(array("?","!",";","(",")",":","[","]"), " ", $str);
    $str = str_replace(array("\n","\r","  "), " ", $str);
    strtolower($str);
if( !function_exists('keyword_count_sort')) {
	function keyword_count_sort($first, $sec)
	{
		return $sec[1] - $first[1];
	}
}
	$str = preg_replace('/[^\p{L}0-9 ]/', ' ', $str);
	$str = trim(preg_replace('/\s+/', ' ', $str));
	
	$words = explode(' ', $str);

	// If we don't restrict tag usage, we'll remove common words from array
	if ($restrict == false) {
	$commonWords = array('much','allways');
	}

	// Restrict Keywords based on values in the $allowedWords array
	// Use if you want to limit available tags
	if ($restrict == true) {
		$admin_tags = getAdminTags();
		$allowedWords = explode(',',$admin_tags);

$words = array_uintersect($words, $allowedWords,'strcasecmp');
	}
	
	$keywords = array();

	while(($c_word = array_shift($words)) !== null)
	{
		if(strlen($c_word) < $minWordLen) continue;
		
		$c_word = strtolower($c_word); 
		if(array_key_exists($c_word, $keywords)) $keywords[$c_word][1]++;
		else $keywords[$c_word] = array($c_word, 1);
	}
	usort($keywords, 'keyword_count_sort');
	
	$final_keywords = array();
	foreach($keywords as $keyword_det)
	{
		if($keyword_det[1] < $minWordOccurrences) break;
		array_push($final_keywords, $keyword_det[0]);
	}
	$final_keywords = array_slice($final_keywords, 0, $maxWords);
	return $asArray ? $final_keywords : implode(', ', $final_keywords);
	} 
}

  // ADMIN MENU
function tags_admin_menu() {
    echo '<h3><a href="#">Tags</a></h3>
    <ul>
        <li><a href="' . osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'admin.php') . '">&raquo; ' . __('Admin', 'tags') . '</a></li>
			<li><a href="' . osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'help.php') . '">&raquo; ' . __('Help', 'tags') . '</a></li>
    </ul>';
}

		// FORM FOR SEARCH SIDEBAR
function tags_search_form($catId = null) {
    include_once 'search_form.php';
}

// PLUGIN SPECIFIC SEARCH CONDITIONS
function tags_search_conditions($params) {
    // we need conditions and search tables (only if we're using our custom tables)
        $has_conditions = false;
 
        foreach($params as $key => $value) {
            // We may want to  have param-specific searches
            switch($key) {
                case 'tags':
                    Search::newInstance()->addConditions(sprintf("%st_item_tags.tags LIKE '%%%s%%'", DB_TABLE_PREFIX, $value));
                    $has_conditions = true;
                    break;
                default:
                    break;
            }
        }
 
        // Only if we have some values at the params we add our table and link with the ID of the item.
        if($has_conditions) {
            Search::newInstance()->addConditions(sprintf("%st_item.pk_i_id = %st_item_tags.fk_i_item_id ", DB_TABLE_PREFIX, DB_TABLE_PREFIX));
            Search::newInstance()->addTable(sprintf("%st_item_tags", DB_TABLE_PREFIX));
        }
}
   // CSS FOR TAGS
function tag_load_style() {
       osc_enqueue_style('TagsCss', osc_base_url() . 'oc-content/plugins/tags/css/tags.css');
   }


// This is needed in order to be able to activate the plugin
osc_register_plugin(osc_plugin_path(__FILE__), 'tags_install');

// This is a hack to show a Uninstall link at plugins table (you could also use some other hook to show a custom option panel)
osc_add_hook(osc_plugin_path(__FILE__)."_uninstall", 'tags_uninstall');

osc_add_hook(osc_plugin_path(__FILE__) . '_configure', 'tags_settings');
osc_add_hook('admin_menu', 'tags_admin_menu');

// HOOKS FOR PLUGIN FUNTIONING
osc_add_hook('posted_item', 'tags_form_post') ;
osc_add_hook('edited_item', 'tags_form_edit') ;
osc_add_hook('delete_item', 'delete_tags_item') ;
osc_add_hook('item_form', 'tags_form');
osc_add_hook('item_edit', 'tags_edit_form');
osc_add_hook( 'item_detail', 'tags_item_detail' ) ;
osc_add_hook( 'item_detail', 'insert_admin_tags' ) ;
osc_add_hook( 'after_html', 'tags_list' ) ;
// HOOK FOR SEARCH
osc_add_hook('search_form', 'tags_search_form');
osc_add_hook('search_conditions', 'tags_search_conditions');
// HOOK FOR CSS
osc_add_hook('init', 'tag_load_style');
?>
