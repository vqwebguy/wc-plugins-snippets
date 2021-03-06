<?php // copy opening php tag only if needed

/**
 * Adds JS code to footer on product pages
 * to swap width and length price calculator field rows
 *
 * This will print on any product, therefore it'd be best
 * to add some checks to ensure it prints on MPC products
 * with width and length needed fields (Area LxW measurement)
 */
function sv_wc_swap_mpc_rows() {

	// bail if we're not on a product page
	if ( ! ( function_exists( 'is_product' ) && is_product() ) ) {
		return;
	}

	wc_enqueue_js( '

			var  $price_calculator = $( "#price_calculator" );

			if ( $price_calculator ) {

				var $length_needed = $price_calculator.find( "label[for=length_needed]" ),
					$width_needed  = $price_calculator.find( "label[for=width_needed]" );

				if ( $length_needed && $width_needed ) {

					$length_tr = $length_needed.closest( "tr" );
					$width_tr  = $width_needed.closest( "tr" );

					$width_tr.after( $length_tr );
				}
			}

	' );
}

add_action( 'wp_enqueue_scripts', 'sv_wc_swap_mpc_rows' );
