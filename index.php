<?php get_header(); ?>

<?php if(have_posts()) : ?>
	<?php while(have_posts()) : the_post(); ?>
	
	<article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<div class="content-wrap mt-4 mb-4">
			

			<div id="demo-hero">
				<div class="px-4 pt-5 my-5 text-center border-bottom">
					<h1 class="display-4 fw-bold">Centered screenshot</h1>
					<div class="col-lg-6 mx-auto">
						<p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
						<div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
							<button type="button" class="btn btn-primary btn-lg px-4 me-sm-3">Primary button</button>
							<button type="button" class="btn btn-outline-secondary btn-lg px-4">Secondary</button>
						</div>
					</div>
					<div class="overflow-hidden" style="max-height: 30vh;">
						<div class="container px-5">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/bootstrap-docs.png" class="img-fluid border rounded-3 shadow-lg mb-4" alt="Example image" width="700" height="500" loading="lazy">
						</div>
					</div>
				</div>
			</div>
			
		</div>
		
	</article>

	<?php endwhile; ?>
<?php else : ?>
	<div class="alert alert-info m-4">
		<strong>Nichts gefunden …</strong>
	</div>
<?php endif; ?>

<?php get_footer(); ?>