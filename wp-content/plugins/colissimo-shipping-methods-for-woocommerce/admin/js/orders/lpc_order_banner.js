jQuery(function ($) {
    $('.lpc__admin__order_banner__header__generation').off('click').on('click', function () {
        $('.lpc__admin__order_banner__generate_label__div').show();
        $('.lpc__admin__order_banner__label_listing').hide();
        $(this).addClass('nav-tab-active');
        $('.lpc__admin__order_banner__header__listing').removeClass('nav-tab-active');
    });

    $('.lpc__admin__order_banner__header__listing').off('click').on('click', function () {
        $('.lpc__admin__order_banner__generate_label__div').hide();
        $('.lpc__admin__order_banner__label_listing').show();
        $(this).addClass('nav-tab-active');
        $('.lpc__admin__order_banner__header__generation').removeClass('nav-tab-active');
    });

    $('.lpc__admin__order_banner__generate_label__item__weight').on('change', function () {
        countTotalWeight($(this));
    });

    $('.lpc__admin__order_banner__generate_label__item__qty').on('change', function () {
        countTotalWeight($(this));
    });

    $('.lpc__admin__order_banner__generate_label__package_weight').on('change', function () {
        countTotalWeight();
    });

    $('.lpc__admin__order_banner__generate_label__item__checkbox').on('change', function () {
        countTotalWeight();
    });

    $('.lpc__admin__order_banner__generate_label__item__check_all').on('change', function () {
        $('.lpc__admin__order_banner__generate_label__item__checkbox').trigger('change');
    });

    countTotalWeight();
    bindOuwtardLabelGeneration();
    bindEditValues();

    function countTotalWeight($trigger = null) {
        if ($trigger !== null) {
            let itemChangedId = $trigger.attr('data-item-id');

            if (!$('#' + itemChangedId + '-checkbox').prop('checked')) {
                return;
            }
        }

        let $adminOrderBanner = $('.lpc__admin__order_banner');

        let totalWeight = 0;

        $adminOrderBanner.find('.lpc__admin__order_banner__generate_label__item__weight').each(function () {
            let itemId = $(this).attr('data-item-id');
            if ($('#' + itemId + '-checkbox').prop('checked')) {
                let qty = parseInt($('#' + itemId + '-qty').val());
                totalWeight += parseFloat($(this).val()) * qty;
            }
        });

        totalWeight += parseFloat($adminOrderBanner.find('.lpc__admin__order_banner__generate_label__package_weight').val());

        let roundedTotalWeight = totalWeight.toFixed(2);

        $adminOrderBanner.find('.lpc__admin__order_banner__generate_label__total_weight').html(roundedTotalWeight);
        $adminOrderBanner.find('input[name="lpc__admin__order_banner__generate_label__total_weight__input"]').val(roundedTotalWeight);
    }

    function bindOuwtardLabelGeneration() {
        $('.lpc__admin__order_banner__generate_label__generate-label-button').off('click').on('click', function () {
            $('input[name="lpc__admin__order_banner__generate_label__action"]').val('1');

            $(this).closest('form').submit();
        });
    }

    function bindEditValues() {
        $('.lpc__admin__order_banner__generate_label__edit_value').off('click').on('click', function () {
            let $generateLabelDiv = $(this).closest('.lpc__admin__order_banner__generate_label__div');

            if ($(this).hasClass('woocommerce-input-toggle--disabled')) {
                $generateLabelDiv.find('.lpc__admin__order_banner__generate_label__item__weight').removeAttr('readonly');
                $generateLabelDiv.find('.lpc__admin__order_banner__generate_label__item__price').removeAttr('readonly');
                $generateLabelDiv.find('.lpc__admin__order_banner__generate_label__shipping_costs').removeAttr('readonly');
                $generateLabelDiv.find('.lpc__admin__order_banner__generate_label__package_weight').removeAttr('readonly');
                $(this).removeClass('woocommerce-input-toggle--disabled');
                $(this).addClass('woocommerce-input-toggle--enabled');
            } else if ($(this).hasClass('woocommerce-input-toggle--enabled')) {
                $generateLabelDiv.find('.lpc__admin__order_banner__generate_label__item__weight').attr('readonly', 'readonly');
                $generateLabelDiv.find('.lpc__admin__order_banner__generate_label__item__price').attr('readonly', 'readonly');
                $generateLabelDiv.find('.lpc__admin__order_banner__generate_label__shipping_costs').attr('readonly', 'readonly');
                $generateLabelDiv.find('.lpc__admin__order_banner__generate_label__package_weight').attr('readonly', 'readonly');
                $(this).removeClass('woocommerce-input-toggle--enabled');
                $(this).addClass('woocommerce-input-toggle--disabled');
            }

        });
    }
});
