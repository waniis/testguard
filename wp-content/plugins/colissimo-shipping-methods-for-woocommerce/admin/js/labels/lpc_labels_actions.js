jQuery(function ($) {
    $('.lpc_label_action_download').off('click').on('click', function () {
        let specificAction = $(this).attr('data-link');
        if (specificAction !== undefined && specificAction !== '') {
            location.href = specificAction;
        }
    });

    $('.lpc_label_action_print').off('click').on('click', function () {
        let specificAction = $(this).attr('data-link');
        let trackingNumber = $(this).attr('data-tracking-number');
        switch ($(this).attr('data-format')) {
            case 'ZPL':
            case 'DPL':
                let lpc_thermal_labels_infos = [
                    {
                        lpc_tracking_number: trackingNumber
                    }
                ];

                printThermal(lpc_thermal_labels_infos);

            // We don't break here because we want to print in PDF the invoice and maybe the CN23
            case 'PDF':
                printPDF(specificAction);
                break;
        }

    });

    $('.lpc_label_action_send_email').off('click').on('click', function () {
        let specificAction = $(this).attr('data-link');
        if (specificAction !== undefined && specificAction !== '') {
            location.href = specificAction;
        }
    });

    $('.lpc_label_action_delete').off('click').on('click', function () {
        let specificAction = $(this).attr('data-link');
        let trackingNumber = $(this).attr('data-tracking-number');
        let labelType = $(this).attr('data-label-type');
        let confirmText = labelType === 'outward' ? lpcLabelsActions.deletionConfirmTextOutward : lpcLabelsActions.deletionConfirmTextInward;

        if (specificAction !== undefined && specificAction !== '') {
            if (window.confirm(trackingNumber + ' : ' + confirmText)) {
                location.href = specificAction;
            }
        }
    });

    function printThermal(thermalLabelsInfos) {
        $.ajax({
            type: 'POST',
            url: lpcLabelsActions.thermalLabelPrintActionUrl,
            data: {lpc_thermal_labels_infos: thermalLabelsInfos},
            dataType: 'json'
        }).success(function (response) {
            let urlsForOrdersdId = $.parseJSON(response);

            Object.keys(urlsForOrdersdId).forEach(trackingNumber => {
                urlsForOrdersdId[trackingNumber].forEach(url => {
                    if (url.length !== 0) {
                        $.ajax({
                            type: 'GET',
                            url: url,
                            dataType: 'html'
                        }).error(function () {
                            console.error('error on label ' + trackingNumber);
                            if ($('#lpc_thermal_print_error_message').length === 0) {
                                displayErrors(lpcLabelsActions.errorMsgPrintThermal);
                            }
                        });
                    }
                });
            });
        }).error(function (error) {
            console.error(error);
        });
    }

    function printPDF(specificAction) {
        if ($('#lpcPrintIframe').length === 0) {
            $('#wpbody-content').append('<iframe type="application/pdf" src="" width="100%" style="display:none;" height="100%" id="lpcPrintIframe"></iframe>');
        }

        let ePdf = document.getElementById('lpcPrintIframe');
        if (ePdf && ePdf.tagName === 'IFRAME') {
            ePdf.src = specificAction;
            ePdf.onload = function () {
                if ($(ePdf).contents().find('body').html() != 'null') {
                    ePdf.contentWindow.focus();
                    ePdf.contentWindow.print();
                }
            };
        }
    }

    function lpc_print_labels(infos) {
        let url = infos.pdfUrl;
        let trackingNumbers = infos.trackingNumbers;
        let type = infos.labelType;

        let splittedTrackingNumbers = trackingNumbers.split(',');

        let thermalPrintInfo = [];

        splittedTrackingNumbers.forEach(function (trackingNumber) {
            thermalPrintInfo.push({
                lpc_tracking_number: trackingNumber
            });
        });

        printThermal(thermalPrintInfo);
        printPDF(url);
    }

    function displayErrors(errorMessage) {
        let $wpHeaderEnd = $('.wp-header-end');

        if ($wpHeaderEnd.length) {
            $wpHeaderEnd.after('<div class="error" id="lpc_thermal_print_error_message"><p>' + errorMessage + '</p></div>');
        } else {
            alert(errorMessage);
        }
    }

    window.lpc_print_labels = lpc_print_labels;
});
