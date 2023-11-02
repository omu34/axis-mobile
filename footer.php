<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Axis-mobile
 */

?>

<footer id="colophon" class="site-footer " style="padding-right:4;" >
		<div class="site-info text-center "  style="background: #FCC100;" >
			<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'New-Axis' ) ); ?>">
			<b>	<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'New-Axis' ), 'Growth Lab' );
				?></b>
			</a>
			<span class="sep"> | </span>
			<b>	<?php
				/* translators: 1: Theme name, 2: Theme author. */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'New-Axis' ), 'New-Axis', '<a href="">@Bernard</a>' );
				?></b>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div>

<?php wp_footer(); ?>
</div>

</body>
</html>
