<script type="text/javascript">
    window.lpc_widget_info = <?php echo $widgetInfo; ?>;
</script>

<style type="text/css">
	<?php if (!empty($lpcAddressTextColor)) { ?>
	#lpc_widget_container div#colissimo-container .couleur1{
		color: <?php echo $lpcAddressTextColor; ?>;
	}

	<?php } ?>

	<?php if (!empty($lpcListTextColor)) { ?>
	#lpc_widget_container div#colissimo-container .couleur2{
		color: <?php echo $lpcListTextColor; ?>
	}

	<?php } ?>

	<?php if (!empty($lpcWidgetFont)) { ?>
	#lpc_widget_container div#colissimo-container .police{
		font-family: <?php echo $lpcWidgetFont; ?>
	}

	<?php } ?>
</style>


<?php $modal->echo_modal(); ?>


<?php if (is_checkout()) { ?>
	<div id="lpc_layer_error_message"></div>
    <?php echo LpcHelper::renderPartial('pick_up' . DS . 'pick_up_info.php', ['relay' => $currentRelay]); ?>
	<div>
        <?php
        if (!empty($currentRelay)) {
            $linkText = __('Change PickUp point', 'wc_colissimo');
        } else {
            $linkText = __('Choose PickUp point', 'wc_colissimo');
        }
        ?>
		<button type="button" id="lpc_pick_up_widget_show_map" class="lpc_pick_up_widget_show_map"><?php echo $linkText; ?></button>
	</div>
<?php } ?>
