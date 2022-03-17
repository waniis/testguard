(function( $ ) {
	'use strict';

	var delay = (function(){
		var timer = 0;
		return function(callback, ms){
			clearTimeout (timer);
			timer = setTimeout(callback, ms);
		};
	})();

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 */

	function printPdf(url) {
		$('#chronopdf').remove();

		$('<iframe id="chronopdf" src="'+url+'" style="display: none" />').appendTo('body');
		var iframe = $('iframe#chronopdf').get(0);

		$('#chronopdf').load(function() {
			setTimeout(function() {
				iframe.focus();
				iframe.contentWindow.print();
			}, 2);
		});

	}

	function create_slot_row(idPlugin, row){
		var el = idPlugin + ' .chronopost-slot-row';

		var lastID = $(el).last().data('id');

		//Handle no rows
		if(typeof lastID == 'undefined' || lastID == ""){
			lastID =1;
		} else {
			lastID = Number(lastID) + 1;
		}

		var day_id;

		var tplLine = '<tr data-id="'+lastID+'" class="chronopost-slot-row">\
			<td>\
				<input type="checkbox" name="delete-slot" value="'+lastID+'">\
			</td>\
			<td>\
			' + Chronopost.from + '\
			</td>\
			<td>\
				<select name="slot['+lastID+'][startday]">';
		for (day_id in Chronopost.weekday) {
			tplLine += '<option value="'+day_id+'"' + (row.startday == day_id ? ' selected="selected"': '') + '>' + Chronopost.weekday[day_id] + '</option>';
		}
		tplLine += '</select>\
				<input type="text" name="slot['+lastID+'][starthour]" value="'+row.starthour+'" class="small-text timepicker">\
			</td>\
			<td>\
				' + Chronopost.to + '\
			</td>\
			<td>\
				<select name="slot['+lastID+'][endday]">';
		for (day_id in Chronopost.weekday) {
			tplLine += '<option value="'+day_id+'"' + (row.endday == day_id ? ' selected="selected"': '') + '>' + Chronopost.weekday[day_id] + '</option>';
		}
		tplLine += '</select>\
				<input type="text" name="slot['+lastID+'][endhour]" value="'+row.endhour+'" class="small-text timepicker">\
			</td>\
		</tr>';

		$(idPlugin+' table tbody tr:last').last().before(tplLine);

		var that;
		$(idPlugin+' table tbody tr:last').prev().find('.timepicker').each(function() {
			that = $(this);
			that.wickedpicker({
				twentyFour: true,
				title: Chronopost.select_time,
				timeSeparator: ':',
				now: that.val()
			});
		})
	}


	function remove_slot_row(idPlugin) {
		$(idPlugin+ ' .chronopost-slot-row [type="checkbox"]:checked').each(function() {
			$(this).closest('tr').remove();
		});
	}

	function create_cookie(name,value,days) {
		if (days) {
			var date = new Date();
			date.setTime(date.getTime()+(days*24*60*60*1000));
			var expires = "; expires="+date.toGMTString();
		}
		else var expires = "";
		document.cookie = name+"="+value+expires+"; path=/";
	}

	function delete_cookie(name) {
		create_cookie(name,"",-1);
	}

	function read_cookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}

	$(document).ready(function() {
		$('.toplevel_page_chronopost').on('click', '.clean-section', function (e) {
			var form = $(this).next();
			var form_elements = form.find('input, select');
			form_elements.each(function (i) {
				$(this).val('')
			});

			e.preventDefault();
		});

		var $toRemove;

		$toRemove = $('label[for="woocommerce_chronoprecise_delivery_date_day"]').closest('tr');

		$('label[for="woocommerce_chronoprecise_delivery_date_day"]').insertAfter('#woocommerce_chronoprecise_delivery_date_day_nbr');
		$('#woocommerce_chronoprecise_delivery_date_day').insertAfter('label[for="woocommerce_chronoprecise_delivery_date_day"]');

		$toRemove.remove();

		$toRemove = $('label[for="woocommerce_chronoprecise_delivery_date_hour"]').closest('tr');

		$('label[for="woocommerce_chronoprecise_delivery_date_hour"]').remove();
		$('#woocommerce_chronoprecise_delivery_date_hour').insertAfter('label[for="woocommerce_chronoprecise_delivery_date_day"]');

		$toRemove.remove();

		$('[data-text-before]').each(function() {
			$(this).before('<span class="text-addition text-before">'+$(this).data('text-before')+'</span>');
		});

		$('[data-text-after]').each(function() {
			$(this).after('<span class="text-addition text-after">'+$(this).data('text-after')+'</span>');
		});

		var today = new Date();

		$('.timepicker').each(function() {
			var $this = $(this)

			$this.wickedpicker({
				twentyFour: true,
				title: Chronopost.select_time,
				timeSeparator: ':',
				now: $this.val() != '' ? $this.val() : today.getHours() + ':' + today.getMinutes()
			});
		});

		if ($('[id$="_slot_settings"]').length) {
			var pluginID = '#'+$('[id$="_slot_settings"]').eq(0).attr('id'),
				slot_options = $(pluginID).data('slot-lines');

			for (var key in slot_options) {
				create_slot_row(pluginID, slot_options[key]);
			}

			$(pluginID).on('click', '.button', function() {
				if ($(this).is('.add')) {
					create_slot_row(pluginID, {
						'startday' : 1,
						'starthour' : '09:00',
						'endday' : 5,
						'endhour' : '18:00'
					});
				} else if ($(this).is('.delete')) {
					remove_slot_row(pluginID);
				}
				return false;
			});
		}

		var create_rate_row, create_zone_row, generate_country_select_list, key,
			country_array = $('.shipping-rate-table').data('countries'),
			lastID = 0,
			options;

		options = $('.shipping-rate-table').data('rate-lines');

		// add new shipping zone row

		create_zone_row = function(row) {
			var el, html = '';
			el = '.shipping-rate-table .chronopost-zone-row';
			lastID = $(el).last().attr('id');
			if (typeof lastID === 'undefined' || lastID === '') {
				lastID = 1;
			} else {
				lastID = Number(lastID) + 1;
			}

			html += '\
					<tr id="' + lastID + '" class="chronopost-zone-row" >\
						<input type="hidden" value="' + lastID + '" name="key[' + lastID + ']"></input>\
						<td><input type="checkbox" class="chronopost-zone-checkbox"></input></span></td>\
						<td><input type="text" size="30" value="' + row["key"] +'"  name="zone-name[' + lastID + ']"/></td>\
						<td>\
							<select multiple="multiple" class="multiselect chosen_select" name="countries[' + lastID + '][]">\
							' + generate_country_select_list(row.countries) + '\
									</select>\
						</td>\
					</tr>\
			';

			html += '\
				<tr class="chronopost-rate-holder">\
					<td colspan="1">\
					</td>\
					<td colspan="2">\
						<table class="chronopost-rate-table shippingrows widefat" id="' + lastID + '_rates">\
							<thead>\
								<tr>\
									<th></th>\
									<th style="width: 30%">' + Chronopost.min_weight + '</th>\
									<th style="width: 30%">' + Chronopost.max_weight + '</th>\
									<th style="width: 40%">' + Chronopost.shipping_rate + '</th>\
								</tr>\
							</thead>\
							' + create_rate_row(lastID, row) +'\
							<tr>\
								<td colspan="3" class="add-rate-buttons">\
									<a href="#" class="add button" name="key_' + lastID + '">' + Chronopost.add_rate + '</a>\
									<a href="#" class="delete button">' + Chronopost.delete_rate + '</a>\
								</td>\
							</tr>\
						</table>\
					</td>\
				</tr>\
			';
			return html;
		};


		// create new rate row

		create_rate_row = function(lastID, row) {
			var row;
			var html = '', i;
			if (row === null || row.rates.length === 0) {
				row = {};
				row.key = '';
				row.countries = [];
				row.rates = [];
				row.rates.push([]);
				row.rates[0].min = '';
				row.rates[0].max = '';
				row.rates[0].shipping = '';
			}
			if (typeof row.min === 'undefined' || row.min === null) {
				row.min = [];
			}
			i = 0;
			while (i < row.rates.length) {
				html += '\
					<tr>\
						<td>\
							<input type="checkbox" class="chronopost-rate-checkbox" id="' + lastID + '"></input>\
						</td>\
						<td>\
							<input type="text" size="20" placeholder="" name="min[' + lastID + '][]" value="' + row.rates[i].min + '"></input>\
						</td>\
						<td>\
							<input type="text" size="20" placeholder="" name="max[' + lastID + '][]" value="' + row.rates[i].max + '"></input>\
						</td>\
						<td>\
							<input type="text" size="10" placeholder="" name="shipping[' + lastID + '][]" value="' + row.rates[i].shipping + '"></input>\
						</td>\
					</tr>\
				';
				i++;
			}
			return html;
		};

		generate_country_select_list = function(keys) {
			var html, key;
			html = '';
			for (key in country_array) {
				if (keys.indexOf(key) !== -1) {
					html += '<option value="' + key + '" selected="selected">' + country_array[key].replace(/\\/g, '') + '</option>';
				} else {
					html += '<option value="' + key + '">' + country_array[key].replace(/\\/g, '') + '</option>';
				}
			}
			return html;
		};

		for (key in options) {
			key = key;
			options[key].key = key.replace(/\\/g, '');
			$('.shipping-rate-table table tbody tr:last').before(create_zone_row(options[key]));
		}


		// new zone row button event

		$('.shipping-rate-table').on('click', '.add-zone-buttons a.add', function() {
			var id, row;
			id = '.shipping-rate-table table tbody tr:last';
			row = {};
			row.key = '';
			row.min = [];
			row.rates = [];
			row.countries = [];
			$(id).before(create_zone_row(row));
			if ($().chosen) {
				$('select.chosen_select').chosen({
					width: '350px',
					disable_search_threshold: 5
				});
			} else {
				$('select.chosen_select').select2();
			}
			return false;
		});


		// delete zone row button event

		$('.shipping-rate-table').on('click', '.add-zone-buttons a.delete', function() {
			var rowsToDelete;
			rowsToDelete = $(this).closest('table').find('.chronopost-zone-checkbox:checked');
			$.each(rowsToDelete, function() {
				var nextRow, thisRow;
				thisRow = $(this).closest('tr');
				nextRow = $(thisRow).next();
				if ($(nextRow).hasClass('chronopost-rate-holder')) {
					$(nextRow).remove();
				} else {
					return;
				}
				$(thisRow).remove();
			});
			return false;
		});


		// new rate row button event

		$('.shipping-rate-table').on('click', '.add-rate-buttons a.add', function() {
			var name, row;
			name = $(this).attr('name');
			name = name.substring(4);
			row = create_rate_row(name, null);
			$(this).closest('tr').before(row);
			return false;
		});


		// delete rate row button event

		$('.shipping-rate-table').on('click', '.add-rate-buttons a.delete', function() {
			var rowsToDelete;
			rowsToDelete = $(this).closest('table').find('.chronopost-rate-checkbox:checked');
			$.each(rowsToDelete, function() {
				$(this).closest('tr').remove();
			});
			return false;
		});

		$(window).load(function() {
			if ($('#alertModal').length) {
				tb_show($('#alertModal').data('title'),'#TB_inline?height='+$('#alertModal').data('height')+'&width='+$('#alertModal').data('width')+'&inlineId=alertModal');
			}
		});

		/*
		$('#wpbody').on('click', '.chrono-print', function(event) {
			printPdf($(this).attr('href'));
			event.preventDefault();
		});
		*/

		var order_id,
			$link,
			$order_row,
			$order_generate_label
		;

		$('.chronopost_page_chronopost-shipping, #chrono_meta_box').on('click', '.chrono-generate-label, .bulkactions .button', function(event) {
			$link = $(this);

			setTimeout(function() {
				$link.attr('disabled', 'disabled');
			}, 100);

			if ($(this).is('.chrono-generate-label')) {
				order_id = $link.data('order-id');
				$order_row = $('#order-'+order_id);
				$order_row.find('.spinner').addClass('is-active');
			} else {
				$link.next('.spinner').addClass('is-active');
			}
			var checkDownloadInterval = setInterval(function() {
				if (read_cookie('ChronopostGenerateProcess') == 'done') {
					window.location.reload();
					clearInterval(checkDownloadInterval);
				}
			}, 150);
		});

		var $insurance_input;
		$(document).on('keyup mouseup', '#insurance_amount', function() {
			$insurance_input = $(this);
			order_id = $insurance_input.data('order-id');
			$order_row = $('#order-'+order_id);

			delay(function(){
				$('.chrono-generate-label').attr('disabled', 'disabled');
				$order_row.find('.spinner').addClass('is-active');
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: ajaxurl,
					cache: false,
					data: {
						'action': 'update_insurance_amount',
						'order_id':   order_id,
						'insurance_amount': $insurance_input.val(),
						'chrono_nonce' : Chronopost.chrono_nonce
					}
				}).done(function(output) {
					if (output.status == 'success') {
						$order_row.find('.spinner').removeClass('is-active');
						$('.chrono-generate-label').removeAttr('disabled');
					} else {
						alert('Une erreur s\'est produite lors de la mise à jour des données. Veuillez rafraîchir la page.');
					}
				});
			}, 1000 );
		});

		var el;

		var isUpdating = false;

		$('#chrono_meta_box').on('change', 'input, select:not([name="ship-saturday"])', function(event) {
			if ( ! isUpdating ) {
				isUpdating = true;

				el = $(this);
				var action = el.data('action');
				if (!action) {
					return false;
				}
				order_id = el.data('order-id');
				$order_row = $('#order-'+order_id);
				$order_row.find('.spinner').addClass('is-active');
				$('#shipment-list').find('.button, button, input[type="submit"]').attr('disabled', 'disabled');
				$.ajax({
					type: 'POST',
					dataType: 'json',
					url: ajaxurl,
					cache: false,
					data: {
						'action': action,
						'order_id':   order_id,
						'new_value': el.val(),
						'chrono_nonce' : Chronopost.chrono_nonce
					}
				}).done(function(output) {
					if (output.status == 'success') {
						$order_row.find('.spinner').removeClass('is-active');
						$('#shipment-list').find('.button, button, input[type="submit"]').removeAttr('disabled');
					} else {
						alert('Une erreur s\'est produite lors de la mise à jour des données. Veuillez rafraîchir la page.');
					}
					isUpdating = false;
				});
				event.preventDefault();
			}


		});

		$('select[name=use-contract]').on('change', function(event) {
			el = $(this);
			order_id = el.data('order-id');
			$order_row = $('#order-'+order_id);
			$order_row.find('.spinner').addClass('is-active');
			$('#shipment-list').find('.button, button, input[type="submit"]').attr('disabled', 'disabled');
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				cache: false,
				data: {
					'action': 'update_order_contract',
					'order_id':   order_id,
					'use_contract': el.val(),
					'chrono_nonce' : Chronopost.chrono_nonce
				}
			}).done(function(output) {
				if (output.status == 'success') {
					$order_row.find('.spinner').removeClass('is-active');
					$('#shipment-list').find('.button, button, input[type="submit"]').removeAttr('disabled');
				} else {
					alert('Une erreur s\'est produite lors de la mise à jour des données. Veuillez rafraîchir la page.');
				}
			});
			event.preventDefault();
		});

		$('#wpbody').on('change', '.ship-on-saturday select, .column-parcels input', function(event) {
			el = $(this);
			order_id = el.data('order-id');
			$order_row = $('#order-'+order_id);
			$order_row.find('.spinner').addClass('is-active');
			$('#shipment-list').find('.button, button, input[type="submit"]').attr('disabled', 'disabled');
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				cache: false,
				data: {
					'action': el.is('.ship-on-saturday select') ? 'update_saturday_shipping' : 'update_parcels',
					'order_id':   order_id,
					'new_value': el.val(),
					'chrono_nonce' : Chronopost.chrono_nonce
				}
			}).done(function(output) {
				if (output.status == 'success') {
					$order_row.find('.spinner').removeClass('is-active');
					$('#shipment-list').find('.button, button, input[type="submit"]').removeAttr('disabled');
				} else {
					alert('Une erreur s\'est produite lors de la mise à jour des données. Veuillez rafraîchir la page.');
				}
			});
			event.preventDefault();
		});

		var sendAjax;
		$('#wpbody .column-dimensions').on('change', ' input', function(event) {
			triggerChangeDimensions($(this));
			event.preventDefault();
		});

		function triggerChangeDimensions(el) {
			order_id = el.data('order-id');
			$order_row = $('#order-'+order_id);
			var dimensions = null;
			if (el.parents('#chrono_meta_box').length) {
				dimensions = $('#chrono_meta_box').find('input[name^=parcels_dimensions]');
				$order_generate_label = $('#chrono_meta_box .chrono-generate-label');
			} else {
				dimensions = $order_row.find('input[name^=parcels_dimensions]');
				$order_generate_label = $order_row.find('.button, button, input[type="submit"]');
			}
			$order_generate_label.attr('disabled', 'disabled');
			clearTimeout(sendAjax);
			sendAjax = setTimeout(function () {
				ajaxUpdateDimensions(order_id, dimensions);
			}, 800);
		}

		function ajaxUpdateDimensions(order_id, dimensions) {
			$order_row.find('.spinner').addClass('is-active');
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				cache: false,
				data: {
					'action': 'update_dimensions',
					'order_id':   order_id,
					'new_value': dimensions.serialize(),
					'chrono_nonce' : Chronopost.chrono_nonce
				}
			}).done(function(output) {
				if (output.status === 'success') {
					$order_generate_label.removeAttr('disabled');
				}
				else {
					$($order_generate_label).on('click', function (event) {
						if($(this).attr('disabled')){
							event.preventDefault();
						}
					});
					if (undefined !== output.message) {
						alert(output.message);
					} else {
						alert('Une erreur s\'est produite lors de la mise à jour des données. Veuillez rafraîchir la page.');
					}
				}
				$order_row.find('.spinner').removeClass('is-active');
			});
		}

		$('body').on('click', 'a[disabled]', function (event) {
			event.preventDefault();
		});


		// Création des lignes de dimensions pour chaque colis
		$('td.column-parcels, .parcels-number').on('blur change', 'input', function () {
			if ($(this).val() > 1) {
				$(".insurance-enable select option[value='no']").prop('selected',true);
				$("#insurance_amount").val(0);
			}
			addDimensions($(this));
		});

		function addDimensions(el) {
			if (el.parents('#chrono_meta_box').length) {
				addDimensionsBlock(el);
			} else {
				addDimensionsRows(el);
			}
		}

		function addDimensionsBlock(el) {
			var total = el.val();
			var template = $('#chrono_meta_box .parcels-dimensions .package-dimensions.default');
			$('#chrono_meta_box .parcels-dimensions .package-dimensions').not('.default').remove();
			for (var i = 2; i <= total; i++) {
				var clone = template.clone().removeClass('default');
				clone.find('input').each(function () {
					var new_name = $(this).attr('name').replace(/\[1\]/, '['+ i +']');
					$(this).attr('name', new_name);
				});
				clone.appendTo($('#chrono_meta_box .parcels-dimensions'));
			}
		}

		function addDimensionsRows(el)
		{
			var total = el.val();
			var $inputWeight = el.parents('tr').find('.column-dimensions:first > input[type="number"]');
			var currentTotal = $inputWeight.length;

			var toAdd = total - currentTotal;

			var templates = el.parents('tr').find('.column-dimensions .default');
			if ( toAdd < 0) {
				templates.each(function() {
					$(this).parent('.column-dimensions').find('input[type="number"]').slice(currentTotal+toAdd).remove();
				});
			} else {
				templates.each(function () {
					for (var i = 1; i <= toAdd; i++) {
						var clone = $(this).clone().removeClass('default');
						var new_name = clone.attr('name').replace(/\[1\]/, '['+ (currentTotal + i) +']');
						clone.attr('name', new_name);
						clone.appendTo($(this).parents('td'));
					}
				});
			}


			triggerChangeDimensions($inputWeight);
		}

		// Ajout d'un nouveau bloc de champs pour un contrat
		$(document).on("click", '.addNewContract', function(event)
		{
			$('.chrono-alert').remove();
			var template = $('.chronopost-settings-account.default').clone();
			var index_el = $('input[name=chronopost_account_index]');
			var newIndex = parseInt(index_el.val()) + 1;
			var removeButtonTemplate = $('#chrono_remove_button_template').clone();
			removeButtonTemplate.removeAttr('style');
			template.removeClass('default');
			template.find('input').each(function () {
				$(this).val('');
				var new_name = $(this).attr('name').replace(/\[1\]/, '['+ newIndex +']');
				$(this).attr('name', new_name);
			});
			template.find('.account-title .index').html(newIndex);
			template.find('.addNewContract').replaceWith(removeButtonTemplate);
			template.find('.contract-delete').append('<button class="removeContract button button-delete">Supprimer contrat</button>');
			$('.chronopost-accounts-settings').append(template);
			index_el.val(newIndex);

			event.preventDefault();
		});

		$(document).on("click", '.removeContract', function(event)
		{
			if (confirm(chrono_alert_remove_contract)) {
				var p = $(this).parents('.chronopost-settings-account');
				p.remove();
			}
			event.preventDefault();
		});

		// Teste les identifiants du contrat
		$(document).on("click", '.testWSLogin', function(event)
		{
			var t = $(this);
			var p = $(this).parents('.chronopost-settings-account');
			$(this).next('.spinner').addClass('is-active');
			$.ajax({
				type: 'POST',
				dataType: 'json',
				url: ajaxurl,
				cache: false,
				data: {
					'action': 'test_login',
					'account':   p.find('.account-number').val(),
					'password':   p.find('.account-password').val(),
					'chrono_nonce' : Chronopost.chrono_nonce
				}
			}).done(function(output) {
				var container = p.find('.testWSLoginResult');
				$('.chrono-alert').remove();
				if (output.status === 'success') {
					$('<div class="chrono-alert chrono-alert-success">'+output.message+'</div>').appendTo(container);
				} else {
					if (undefined === output.message) {
						output.message = 'Identifiants invalides';
					}
					$('<div class="chrono-alert chrono-alert-error">'+output.message+'</div>').appendTo(container);
				}
				t.next('.spinner').removeClass('is-active');
			});
			event.preventDefault();
		});

		if ($('.woocommerce_page_wc-settings .woocommerce .subsubsub a[href*="&section=chrono"]').length) {
			var adminSettingsLinks = '<ul class="sub-menu">',
				isCurrent = false;
			$('.woocommerce_page_wc-settings .woocommerce .subsubsub a[href*="&section=chrono"]').each(function() {
				adminSettingsLinks += '<li>';
				if ($(this).hasClass('current')) {
					isCurrent = true;
					adminSettingsLinks += '<a class="current" href="' + $(this).attr('href') + '">';
				} else {
					adminSettingsLinks += '<a href="' + $(this).attr('href') + '">';
				}
				adminSettingsLinks += $(this).text();
				adminSettingsLinks += '</a>';
				adminSettingsLinks += '</li>';
				$(this).parent('li').remove();
			});
			adminSettingsLinks += '</ul>';

			$('.woocommerce_page_wc-settings .woocommerce .subsubsub').append('<li class="has-sub"><a href="javascript:;"' + (isCurrent ? ' class="current"': '') + '>Chronopost</a>' + adminSettingsLinks + '</li>');
		}
	});

})( jQuery );
