<?php
// Define a custom menu hierarchy so that a multi level menu can be built in Wordpress Header
// PHP Code below should be placed inside functions.php, or as a separate file and then included into functions.php

// Register a menu so that we can edit it through WP Admin
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus( array(
      	"primary_nav" => 'Primary Navigation - Header',
      	"secondary_nav" => "Footer Navigation - Footer",
      	"site_map" => 'Site Map'
    ) );
}

function wcm_get_menu_name ( $menu_location, $echo = false ) {
	$menu_locations = get_nav_menu_locations();
    $menu = wp_get_nav_menu_object( $menu_locations[ $menu_location ] );

    if ( $echo ) {
    	echo $menu->name;
    } else {
    	return $menu->name;
    }
}

function wcm_get_link_tag ( $menu_item, $args = array() ) {
	$defaults = array(
		'before' => '',
		'after' => '',
		'classes' => ''
	);
	$args = wp_parse_args( $args, $defaults );

	if ( isset($menu_item['target']) && '' !== $menu_item['target'] ) {

		$link_tag = sprintf(
			'<a class="%s" href="%s" title="%s" target="%s">%s%s%s</a>',
			$args['classes'],
			$menu_item['url'],
			$menu_item['title'],
			$menu_item['target'],

			$args['before'],
			$menu_item['title'],
			$args['after']
		);
		
	} else {

		$link_tag = sprintf(
			'<a class="%s" href="%s" title="%s">%s%s%s</a>',
			$args['classes'],
			$menu_item['url'],
			$menu_item['title'],

			$args['before'],
			$menu_item['title'],
			$args['after']
		);

	}

	return $link_tag;
}

if ( !class_exists( 'WP_Custom_Menu' ) ) {

	class WP_Custom_Menu {

		public $menu_name = null;
		public $levels = array();

		public $ul_classes = '';
		public $li_classes = '';
		public $a_classes = '';

		protected $_menu_items = null;
		protected $_menu_list = '';

		protected $_current = null;

		function __construct($menu_name) {
			$this->menu_name = $menu_name;
			$this->_get_menu_items();
		}

		public function set_current_post( $post, $post_type = '' ) {
			if (!isset($post)) {
				return false;
			}

			if ( is_search() ) {
				return false;
			}

			if ( is_integer( $post ) ) {
				if ( $post_type === '' ) {
					// Post ID passed, get full post
					$post = get_post( $post );
					
					$post_id = $post->ID;
					$post_type = $post->post_type;
				} else {
					// Post ID & Type EXPLICITLY declared
					$post_id = $post;
				}
			} else if ( is_a( $post, 'WP_Post' ) ) {
				$post_id = $post->ID;
				$post_type = $post->post_type;
			}


			$items_reversed = array_reverse($this->_menu_items, true);
			$parent = -1;
			foreach ($items_reversed as $id => $item) {
				// Reset all other current values
				$this->_menu_items[$id]['current'] = false;

				if ( $item['post_id'] === $post_id && $item['post_type'] == $post_type ) {
					$this->_menu_items[$id]['current'] = true;
					$parent = $item['parent'];
					$this->_current = $post_id;
				}
				if ($id === $parent) {
					$this->_menu_items[$id]['current'] = true;
					$parent = $item['parent'];
					// if ($parent === 0) {
					// 	break;
					// }
					$this->_current = $post_id;
				}
			}
		}

		public function has_current() {
			return isset( $this->_current ) && $this->_current !== null;
		}

		protected function _count_descendant_levels() {
			foreach ($this->_menu_items as $id => $item) {
				$temp_item = $item;
				$n = 0;
				while ($temp_item['parent'] !== 0) {
					$parent = ( $temp_item['parent'] !== 0) ? $temp_item['parent'] : $parent;
					$temp_item = $this->_menu_items[ $temp_item['parent'] ];
					$n++;

					$this->_menu_items[$parent]['descendant_levels'] = max( $n, $this->_menu_items[$parent]['descendant_levels'] );
				}
			}
		}

		public function get_simple_menu() {
			global $post;
			if ( !isset($this->menu_name) ) {
				// throw new Exception('Menu Name is not defined');
				return false; // Fail early if not set
			}

			if ( isset($this->_menu_items) ) {
				$previous_level = 0;
				$level_change = 0;
				$this->_menu_list .= '<ul id="menu-'.$this->menu_name.'" class="'.$this->ul_classes.'">';
				foreach ($this->_menu_items as $item) {
					// Calculate the level change, and open/close ul tags as necessary
					if ( $previous_level !== $item['level'] ) {
						$level_change = $item['level'] - $previous_level;
						$previous_level = $item['level'];
					} else {
						$level_change = 0;
					}

					if ($level_change > 0) {
						$this->_menu_list .= str_repeat('<ul>', $level_change);
					} else if ($level_change < 0) {
						$this->_menu_list .= str_repeat( '</ul>', abs($level_change) );
					}
					$level_change = 0;

					// Output actual menu item
					$li_classes = $this->li_classes;
					if ( $item['current'] ) {
						$li_classes .= ' is-current';
					}

					$this->_menu_list .= '<li class="'.$li_classes.'">';
					$this->_menu_list .= wcm_link_tag( $item, array( 'classes' => $this->a_classes ) );
					$this->_menu_list .= '</li>';
				}
				if ($previous_level > 0) {
					$this->_menu_list .= str_repeat('</ul>', $previous_level);
					$previous_level = 0;
				}
				$this->_menu_list .= '</ul>';
			} else {
				$this->_menu_list = false;
			}
			return $this->_menu_list;
		}
		public function the_simple_menu() {
			echo $this->get_simple_menu();
		}

		public function get_items_for_level($level = 0) {
			$filtered_items = array();
			foreach ($this->_menu_items as $id => $item) {
				if ($item['level'] === $level) {
					$filtered_items[$id] = $item;
				}
			}
			return $filtered_items;
		}

		public function has_items_for_level($level = 0) {
			return count( $this->get_items_for_level( $level ) ) > 0;
		}

		public function get_items_for_parent($parent = 0) {
			$filtered_items = array();
			foreach ($this->_menu_items as $id => $item) {
				if ($item['parent'] === $parent) {
					$filtered_items[$id] = $item;
				}
			}
			return $filtered_items;
		}

		public function has_items_for_parent($parent = 0) {
			return count( $this->get_items_for_parent( $parent ) ) > 0;
		}

		protected function _get_menu_items() {
			// Get the nav menu based on $menu_name (same as 'theme_location' or 'menu' arg to wp_nav_menu)
		    if ( ( $locations = get_nav_menu_locations() ) && isset( $locations[ $this->menu_name ] ) ) {
				$menu = wp_get_nav_menu_object( $locations[ $this->menu_name ] );

				$menu_items = wp_get_nav_menu_items($menu->term_id);
				$this->_menu_items = wp_get_nav_menu_items($menu->term_id);
				$this->_get_menu_levels();
				$this->_count_descendant_levels();
				return true;  
			} else {
				return false;
			}
			// If here error occurred
			return false;
		}

		protected function _get_menu_levels() {
			$menu_objects = array();
			foreach ($this->_menu_items as $item) {
				$parent =  (integer)$item->menu_item_parent;
				$menu_object = array(
					'post_id' => (integer)$item->object_id,
					'post_type' => (string)$item->object,
					'url' => $item->url,
					'title' => $item->title,
					'parent' => $parent,
					'current' => false,
					'descendant_levels' => 0,
					'classes' => $item->classes,
					'target' => $item->target,
				);
				if ($parent === 0) {
					$menu_object['level'] = 0;
				} else {
					$menu_object['level'] = $menu_objects[$parent]['level'] + 1;
				}
				$menu_objects[$item->ID] = $menu_object;

				if ( !in_array( $menu_object['level'], $this->levels ) ) {
					// Add to levels property
					$this->levels[] = $menu_object['level'];
				}
			}
			$this->_menu_items = $menu_objects;
		}
		
	}

}

?>
