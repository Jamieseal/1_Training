<?php
/**
 * The template for displaying the footer.
 *
 */
?>
 	<footer class="footer clearfix">
 		<div class="container">
 			<ul class="menu">

                <li class="menu__item">
                    <a href="<?php echo get_the_permalink(38); ?>">Terms & Conditions</a>
                </li>

            </ul>
 		</div>
 	</footer>

 	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <script type="text/javascript">
	    $(document).ready(function(){
			$('a.gallery').featherlightGallery();
		});
    </script>

    <?php wp_footer(); ?>

</body>
</html>