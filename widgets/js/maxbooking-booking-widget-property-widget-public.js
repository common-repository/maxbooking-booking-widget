(function( $ ) {
    'use strict';

    function initDatepicker() {
        var now = new Date();
        var timestamp = new Date(now.getFullYear(), now.getMonth(), now.getDate()) / 1;
        var inputElems = $('.maxbooking-booking-widget-arrival input[name="arrival_date"]');

        // Create datepickers
        inputElems.pickadate({
			format: 'd mmm, yyyy',
            onClose: function() {
                // Ensure datepicker doesn't open on refocusing the window
                $(document.activeElement).blur();
            },
            onRender: function() {
                // Ensure only the current month day is highlighted (not every day with the same number)
                $('div.picker__day--highlighted').each(function(index, value) {
                    if ($(this).data('pick') !== timestamp) {
                        $(this).removeClass('picker__day--highlighted');
                    }
                });
            },
            min: new Date(),
            onSet: function() {
                var item = this.get('select');
                if (!item) {
                    return;
                }
                var formElem = this.$node.parents('form');
                formElem.find('input[name="ad_tt"]').val(formatNumber(item.date));
                formElem.find('input[name="ad_mm"]').val(formatNumber(item.month+1));
                formElem.find('input[name="ad_yyyy"]').val(item.year);
            }
        });

        // Set default arrival date (if defined)
        inputElems.each(function(){
            var defaultArrivalDate = new Date();
            var inputElem = $(this);
            var arrivalDateOffset = inputElem.attr('data-arrival-date-offset');
            if ('none' !== arrivalDateOffset) {
                defaultArrivalDate.setTime( defaultArrivalDate.getTime() + arrivalDateOffset * 86400000 );
                inputElem.pickadate('picker').set('select', defaultArrivalDate);
            }
        })
        
        
    }

    function initAnalytics() {
        var ga = window[window['GoogleAnalyticsObject'] || 'ga'];
        if (typeof ga !== 'function') {
            return;
        }
        ga('require', 'linker');
        ga('linker:autoLink', ['maxbooking.com']);
    }

    function propertySelectChangeHandler(event) {
        var select = $(event.target);
        var form = select.parents('form');
        var url = form.attr('action').replace(/id=\d+/, 'id='+select.val());
        form.attr('action', url);
    }

    function submitHandler(event) {
        var formElem = $(this);
        if (!formElem.find('input[name="ad_tt"]').val()
            || !formElem.find('input[name="ad_mm"]').val()
            || !formElem.find('input[name="ad_yyyy"]').val()
        ){
            event.preventDefault();
        }
    }

    function formatNumber(value) {
        return value<10?'0'+value:value;   
    };

    $(function() {
        initDatepicker();
        initAnalytics();
        $('.maxbooking-booking-widget-widget select[name="property"]')
            .change(propertySelectChangeHandler);
        $('form.maxbooking-booking-widget-widget')
            .submit(submitHandler);
    });

})( jQuery );