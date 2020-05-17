<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BeOnePage
 */

get_header(); ?>



	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div id="primary" class="content-area">
					<main id="main" class="site-main" role="main">
						<?php
							while ( have_posts() ) : the_post();
								get_template_part( 'template-parts/content', 'page' );
							
								// If comments are open or we have at least one comment, load up the comment template.
								if ( comments_open() || get_comments_number() ) {
									comments_template();
								}
                            endwhile; // End of the loop.
                            require_once("functions/report.php");
                           extract(getStats());
                            ?>

                            <table >
                                
                                <tr>
                                    <th>Import and scraping
                                        <table style="width:300px;">
                                <tr><td>Total Records</td><td><?=$total?></td></tr>
                                <tr><td>Original Records</td><td><?=$original_records?></td></tr>
                                <tr><td>Added Records</td><td><?=$added?></td></tr>

                                <tr><td>Marked as Acquired</td><td><?=$acquired?></td></tr>
                                <tr><td>Marked as Pivoted</td><td><?=$pivoted?></td></tr>
                                <tr><td>Marked as Defunct</td><td><?=$defunct?></td></tr>



                                <tr><td>No Link</td><td><?=$no_link?></td></tr>
                                <tr><td>Hyperlinks</td><td><?=$hyperlinks?></td></tr>
                                <tr><td>Scraped</td><td><?php echo $scraped?></td></tr>
                                <tr><td>Scraping Errors</td><td><?php echo $errors?></td></tr>
                                <tr><td>PDF Links</td><td><?php echo $pdfs?></td></tr>
                                
                            </table>
                        </th>
                        <th>
                              <table>
                                  Social 
                                  <?php $social_count=0;?>

                                <tr><td>Twitter</td><td><?=$twitters?></td></tr>
                                <tr><td>Facebook</td><td><?=$facebooks?></td></tr>
                                <tr><td>Linkedin</td><td><?=$linkedins?></td></tr>
                                <tr><td>Instagram</td><td><?=$instagrams?></td></tr>
                                <tr><td>Github</td><td><?=$githubs?></td></tr>
                                <tr><td>YouTube</td><td><?=$youtubes?></td></tr>
                                <tr><td>Vimeo</td><td><?=$vimeos?></td></tr>
                                <tr><td>Tumblr</td><td><?=$tumblrs?></td></tr>
                                <tr><td>Pinterest</td><td><?=$pinterests?></td></tr>
                                <tr><td>YouTube</td><td><?=$youtubes?></td></tr>
                                <tr><td>Google  Plus</td><td><?=$google_pluses?></td></tr>
                                <tr><td>Behance</td><td><?=$behances?></td></tr>
                                <tr><td>Medium</td><td><?=$mediums?></td></tr>
                                <tr><td>Slack</td><td><?=$slacks?></td></tr>
                                <tr><td>Telegram</td><td><?=$telegrams?></td></tr>
                                <tr><td>Skype</td><td><?=$skypes?></td></tr>
                                <tr><td>Flickr</td><td><?=$flickrs?></td></tr>
                                <tr><td>RSS</td><td><?=$rsses?></td></tr>
                                
                               
                            </table>
                        </th>
 <th>
                              <table>
                                 
                                   <tr><th>Contact</td><td></td></tr>
                                <tr><td>Emails</td><td><?=$emails?></td></tr>
                             <tr><td>Phone</td><td><?=$phones?></td></tr>

                                
                               
                            </table>
                        </th>


                        </tr>
                                
                               
                            </table>
                            <?php
                               


						?>
					</main><!-- #main -->
				</div><!-- #primary -->
			</div><!-- col-md-12 -->
		</div><!-- .row -->
	</div><!-- .container -->

<?php get_footer(); ?>
