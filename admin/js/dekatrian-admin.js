jQuery(document).ready(function ($) {

    (function () {

        var select = 'input[name*="date_format"]',
            value = $(select).val();

        $(select).change(function () {
            value = this.value;

            if(value != 'custom'){
                $("#date_format-custom").val(value);
                $(".example").html($(this).next().html());
            }


            $('.form-table').filter(function () {
                return $(this).hasClass('active');
            }).removeClass('active');

            if (value > 2) 
                $('.form-table.page_type').addClass('active');
            
        });

        $('#date_format-custom').on("focus", function(){ $('input[name*="date_format"][value="custom"]').prop("checked", true); })

        /**
         * From here and on we deal with the tabs module.
         */
        function s_s_display_section(_this) {

            $('.section', '.dekatrian form').removeClass('active');

            selector = _this.attr('href');

            $(selector).addClass('active');

        }

        $('body').on('click', 'a[href$="-tab"]', function (e) {

            e.preventDefault();

            $this = $('.dekatrian .nav-tab-wrapper a[href="' + $(this).attr('href') + '"]');
            $('a', '.dekatrian .nav-tab-wrapper').removeClass('nav-tab-active');

            $this.addClass('nav-tab-active');

            s_s_display_section($this);

        });

    })();

});