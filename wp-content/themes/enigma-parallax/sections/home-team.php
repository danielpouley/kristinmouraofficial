<?php
if ( enigma_parallax_theme_is_companion_active() ) {
	$team_home = absint(get_theme_mod( 'team_home','1' )) ;
	if ( $team_home == "1" ) {
    	/* Executes the action for services section hook named 'wl_companion_cservice' */
        do_action( 'wl_companion_team');
    }
}