jQuery(document).ready(function ($) {

	function tdw_reset_form_add(complete) {
		if (complete) $('#tdw-form-add-taxonomy').val('');
		$('.tdw-edit-rule').hide();
		$('#tdw-form-add-choose-term').html('');
		$('#tdw-form-add-div-2').hide();
		$('#tdw-form-add-div-3').hide();
		$('#tdw-form-add-div-4').hide();
		$('#tdw-form-add-div-5').hide();
		$('#tdw-form-add-choose-submit').hide();
		$('.tdw-hide-empty-type').hide();
		$('#tdw-form-add').removeClass('tdw-ajax-loading');
		//Really reset
		$('#tdw-form-add').find('input[type=text], input[type=number], textarea').val('');
		$('#tdw-form-add-type').val('');
		$('#tdw-form-add-disable-coupon').val('1');
		$('#tdw-form-add-active').val('1');
	}

	//Add form - Choose Taxonomy
	$('body').on('change', '#tdw-form-add-taxonomy', function() {
		$('#tdw-form-add').addClass('tdw-ajax-loading');
		tdw_reset_form_add(false);
		if ($('#tdw-form-add-taxonomy').val()=='') {
			//
		} else {
			$.post(
				ajaxurl,
				{
					'action': 'tdw_form_add_choose_taxonomy',
					'taxonomy': $('#tdw-form-add-taxonomy').val(),
					'last_priority': $('#tdw-last-priority').val(),
				},
				function(response) {
					$('#tdw-form-add-choose-term').html(response);
					$('#tdw-form-add-priority').val(parseInt($('#tdw-last-priority').val())+1);
					$('#tdw-form-add').removeClass('tdw-ajax-loading');
				}
			);
		}
	});

	//Add form - Choose term
	$('body').on('change', '#tdw-form-add-term', function() {
		$('#tdw-form-add').addClass('tdw-ajax-loading');
		if ($('#tdw-form-add-term').val()=='') {
			$('#tdw-form-add-div-2').hide();
			$('#tdw-form-add-div-3').hide();
			$('#tdw-form-add-div-4').hide();
			$('#tdw-form-add-div-5').hide();
			$('#tdw-form-add-choose-submit').hide();
		} else {
			$('#tdw-form-add-div-2').show();
		}
		$('#tdw-form-add').removeClass('tdw-ajax-loading');
	});

	//Add form - Choose discount type
	$('body').on('change', '#tdw-form-add-type', function() {
		$('#tdw-form-add').addClass('tdw-ajax-loading');
		$('.tdw-hide-empty-type').hide();
		if ($('#tdw-form-add-type').val()=='') {
			$('#tdw-form-add-div-3').hide();
			$('#tdw-form-add-div-4').hide();
			$('#tdw-form-add-div-5').hide();
			$('#tdw-form-add-choose-submit').hide();
		} else {
			$('#tdw-form-add-choose-type-'+$('#tdw-form-add-type').val()).show();
			$('#tdw-form-add-div-3').show();
			$('#tdw-form-add-div-4').show();
			$('#tdw-form-add-div-5').show();
			$('#tdw-form-add-choose-submit').show();
			$('.tdw-date-field').datepicker({
				dateFormat : 'yy-mm-dd'
			});
		}
		$('#tdw-form-add').removeClass('tdw-ajax-loading');
	});

	//Add form - Submit
	$('body').on('submit', '#tdw-form-add', function() {
		$('#tdw-form-add .form-invalid').removeClass('form-invalid');
		if (
			$('#tdw-form-add-taxonomy').val()!=''
			&&
			$('#tdw-form-add-term').val()!=''
			&&
			$('#tdw-form-add-priority').val()>0
			&&
			$('#tdw-form-add-type').val()!=''
		) {
			var $fields = $('#tdw-form-add :input.required:visible');
			var $emptyFields = $fields.filter(function() {
				if ($.trim(this.value) === "") {
					$('#'+this.id).parent().addClass('form-invalid');
					return true;
				} else {
					return false;
				}
			});
			if (!$emptyFields.length) {
				var go = true;
				//Extra validations
				switch($('#tdw-form-add-type').val()) {
					case 'percentage':
						if ( parseInt($('#tdw-form-add-percentage-value').val())<1 || parseInt($('#tdw-form-add-percentage-value').val())>99) {
							$('#tdw-form-add-percentage-value').parent().addClass('form-invalid');
							go = false;
						}
						break;
					case 'x-for-y':
						if ( parseInt($('#tdw-form-add-x-for-y-x').val())<1 ) {
							$('#tdw-form-add-x-for-y-x').parent().addClass('form-invalid');
							go = false;
						}
						if ( parseInt($('#tdw-form-add-x-for-y-y').val())<1 ) {
							$('#tdw-form-add-x-for-y-y').parent().addClass('form-invalid');
							go = false;
						}
						if ( parseInt($('#tdw-form-add-x-for-y-y').val()) >= parseInt($('#tdw-form-add-x-for-y-x').val()) ) {
							$('#tdw-form-add-x-for-y-y').parent().addClass('form-invalid');
							go = false;
						}
						break;
				}
				if (go) {
					$('#tdw-form-add').addClass('tdw-ajax-loading');
					$.post(
						ajaxurl,
						$('#tdw-form-add').serialize()+'&action=tdw_form_add_submit',
						function(response) {
							if ( response == '1' ) {
								//Clear form
								tdw_reset_form_add( true );
								//Update table
								tdw_update_rules_table();
							} else {
								alert( 'Error' );
								$('#tdw-form-add').removeClass('tdw-ajax-loading');
							}
						}
					);
				}
			}
		}
		return false;
	});

	//Rules table - update
	function tdw_update_rules_table() {
		$('#tdw-rules-table').addClass('tdw-ajax-loading');
		$('#tdw-rules-table').load(
			ajaxurl,
			{
				'action' : 'tdw_rules_table',
				'rand' : Date.now()
			},
			function() {
				$('#tdw-rules-table').removeClass('tdw-ajax-loading');
				$('.tdw-date-field').datepicker({
					dateFormat : 'yy-mm-dd'
				});
			}
		);
	}

	//Rules table - edit
	$('body').on('click', '#tdw-rules-table span.edit a', function(ev) {
		ev.preventDefault();
		tdw_reset_form_add(true);
		//$('.tdw-edit-rule').hide(); //on the reset form add
		$('#tdw-edit-rule-'+$(this).attr('data-meta-id')).show();
		$('#tdw-edit-form-id').val($(this).attr('data-meta-id'));
		$('.tdw-date-field').datepicker({
			dateFormat : 'yy-mm-dd'
		});
	});


	//Edit form - Submit
	$('body').on('submit', '#tdw-form-edit', function() {
		$('#tdw-form-edit .form-invalid').removeClass('form-invalid');
		var id_meta=$('#tdw-edit-form-id').val();
		var $fields = $('#tdw-form-edit :input.required:visible');
		var $emptyFields = $fields.filter(function() {
			if ($.trim(this.value) === "") {
				$('#'+this.id).parent().addClass('form-invalid');
				return true;
			} else {
				return false;
			}
		});
		if (!$emptyFields.length) {
			var go = true;
			//Extra validations
			switch($('#tdw-form-edit-type-'+id_meta).val()) {
				case 'percentage':
					if ( parseInt($('#tdw-form-edit-percentage-value-'+id_meta).val())<1 || parseInt($('#tdw-form-edit-percentage-value-'+id_meta).val())>99) {
						$('#tdw-form-edit-percentage-value-'+id_meta).parent().addClass('form-invalid');
						go = false;
					}
					break;
				case 'x-for-y':
					if ( parseInt($('#tdw-form-edit-x-for-y-x-'+id_meta).val())<1 ) {
						$('#tdw-form-edit-x-for-y-x-'+id_meta).parent().addClass('form-invalid');
						go = false;
					}
					if ( parseInt($('#tdw-form-edit-x-for-y-y-'+id_meta).val())<1 ) {
						$('#tdw-form-edit-x-for-y-y-'+id_meta).parent().addClass('form-invalid');
						go = false;
					}
					if ( parseInt($('#tdw-form-edit-x-for-y-y-'+id_meta).val()) >= parseInt($('#tdw-form-edit-x-for-y-x').val()) ) {
						$('#tdw-form-edit-x-for-y-y-'+id_meta).parent().addClass('form-invalid');
						go = false;
					}
					break;
			}
			if (go) {
				$('#tdw-form-edit').addClass('tdw-ajax-loading');
				$.post(
					ajaxurl,
					$('#tdw-edit-rule-'+id_meta).find('select, textarea, input').serialize()+'&meta_id='+id_meta+'&action=tdw_form_edit_submit',
					function(response) {
						if (response == '1') {
							//Update table
							tdw_update_rules_table();
						} else {
							alert('Error');
						}
						$('#tdw-form-edit').removeClass('tdw-ajax-loading');
					}
				);
			}
		}
		return false;
	});

	//Rules table - delete
	$('body').on('click', '#tdw-rules-table span.deleterule a', function(ev) {
		ev.preventDefault();
		if (confirm(strings.are_you_sure_delete_rule)) {
			$('#tdw-rules-table').addClass('tdw-ajax-loading');
			$('#tdw-form-add-2').html('');
			$('#tdw-form-add-taxonomy').val('');
			$('.tdw-hide-empty-type').hide();
			$.post(
				ajaxurl,
				{
					'action': 'tdw_delete_rule',
					'meta_id': $(this).attr('data-meta-id')
				},
				function(response) {
					if (response == '1') {
						//Update table
						tdw_update_rules_table();
					} else {
						alert('Error');
						$('#tdw-rules-table').removeClass('tdw-ajax-loading');
					}
				}
			);
		}
	});

	//Rules table - delete
	$('body').on('click', '#tdw-rules-table span.editcancel a', function(ev) {
		ev.preventDefault();
		tdw_reset_form_add(true);
		tdw_update_rules_table();
	});

	//Rules table - reload
	$('body').on('click', '#tdw-form-reload', function(ev) {
		ev.preventDefault();
		tdw_update_rules_table();
	});

});