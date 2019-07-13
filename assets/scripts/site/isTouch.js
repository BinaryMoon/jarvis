/**
 * JS mobile detection.
 * Is this a touch enabled device or not?
 *
 * @return boolean
 */
var is_touch_device = function() {

	return ( ( 'ontouchstart' in window ) || ( navigator.MaxTouchPoints > 0 ) || ( navigator.msMaxTouchPoints > 0 ) );

};