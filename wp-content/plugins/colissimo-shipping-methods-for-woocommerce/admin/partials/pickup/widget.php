<script type="text/javascript">
    window.lpc_widget_info = <?php echo $args['widgetInfo']; ?>;
</script>

<style type="text/css">
	<?php if (!empty($args['lpcAddressTextColor'])) { ?>
	#lpc_widget_container div#colissimo-container .couleur1{
		color: <?php echo $args['lpcAddressTextColor']; ?>;
	}

	<?php } ?>

	<?php if (!empty($args['lpcListTextColor'])) { ?>
	#lpc_widget_container div#colissimo-container .couleur2{
		color: <?php echo $args['lpcListTextColor']; ?>
	}

	<?php } ?>

	<?php if (!empty($args['lpcWidgetFont'])) { ?>
	#lpc_widget_container div#colissimo-container .police{
		font-family: <?php echo $args['lpcWidgetFont']; ?>
	}

	<?php } ?>
</style>


<?php $args['modal']->echo_modal(); ?>


<div>
    <?php
    $linkText = __('Choose PickUp point', 'wc_colissimo');
    ?>
	<a id="lpc_pick_up_widget_show_map" class="lpc_pick_up_widget_show_map"><?php echo $linkText; ?></a>
</div>
