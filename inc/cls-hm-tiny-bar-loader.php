<?php
/**
 * General action, hooks loader
*/
class HMTB_Loader 
{
	protected $hmtb_actions;

	protected $hmtb_filters;

	public function __construct() {
		$this->hmtb_actions = array();
		$this->hmtb_filters = array();
	}

	public function add_action( $hook, $component, $callback ) {
		$this->hmtb_actions = $this->add( $this->hmtb_actions, $hook, $component, $callback );
	}

	public function add_filter( $hook, $component, $callback ) {
		$this->hmtb_filters = $this->add( $this->hmtb_filters, $hook, $component, $callback );
	}

	private function add( $hooks, $hook, $component, $callback ) {
		$hooks[] = array( 'hook' => $hook, 'component' => $component, 'callback' => $callback );
		return $hooks;
	}

	public function hmtb_run() {
		 foreach ( $this->hmtb_filters as $hook ) {
			 add_filter( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		 }

		 foreach ( $this->hmtb_actions as $hook ) {
			 add_action( $hook['hook'], array( $hook['component'], $hook['callback'] ) );
		 }
	}
	
}
?>