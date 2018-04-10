$(document).ready(function () {
    $("#submit_select_column").bind("click", function (e) {
        e.preventDefault();
        var elm = $("#step_select_column");
        var error_string = "";

        $.each($elm.find('input.required, select.required'), function (key, val) {
            if (!$(val).val()) {
                error_string = "The " + $(val).attr('data-label') + " field is required";
                $(val).parents('.input-field').find('.input-error').remove();
                $(val).parents('.input-field').append('<span class="input-error">' + error_string + '</span>');
            }
        });

        // valid
        var x = $("#step_select_column").find('input[type=checkbox]:checked');
        $.each(x, function (key, val) {
            // $("#field_order").append("<li>" + $(val).attr('data-label') + "</li>");
            $("#field_order").append(tmpl('tmpl-selected-field', {label: $(val).attr('data-label'), id: $(val).val()}));
        });
        sortable('.sortable');
        $("#step_select_column").addClass("hide").removeClass('active');
        $("#step_field_order").removeClass("hide").addClass('active');
    });
    $("#submit_field_order").bind("click", function (e) {
        e.preventDefault();
        var x = $("#step_field_order").find('input[type=hidden].selected-field');
        var or = new Array();
        $.each(x, function (key, val) {
            or.push(parseInt($(val).val()));
        });
        $("#step_field_order").addClass("hide").removeClass("hide");
        $("#step_report_criteria").removeClass("hide").addClass('active');

        console.log(or);
    });

    $("#submit_report_criteria").bind("click", function (e) {
        e.preventDefault();

        $("#step_report_criteria").addClass("hide").removeClass("hide");
        $("#step_report_info").removeClass("hide").addClass('active');
    });

    $("#submit_report_template").bind("click", function (e) {
        e.preventDefault();

        // populate advanced filter
        var adv_filter = new Array();
        $.each($(".adv-filter"), function (key, elm) {
            if ($(elm).find("select[name='ReportWizardForm[filter_field]']").val()) {
                var json = {
                    "id": $(elm).find("select[name='ReportWizardForm[filter_field]']").val(),
                    "op": $(elm).find("select[name='ReportWizardForm[filter_operator]']").val(),
                    "value": $(elm).find("input[name='ReportWizardForm[filter_value]']").val()
                };
                adv_filter.push(json);
            }
        });
        console.log(adv_filter);

        // populate limit row count
        var limit_row = $("#limit_row").val();

        // populate sorting order
        var sorting_order = new Array();
        $.each($(".sorting-order"), function (key, elm) {
            if ($(elm).find("select[name='ReportWizardForm[order_field]']").val()) {
                var json = {
                    "id": $(elm).find("select[name='ReportWizardForm[order_field]']").val(),
                    "type": $(elm).find("select[name='ReportWizardForm[order_type]']").val()
                };
                sorting_order.push(json);
            }
        });
        console.log(sorting_order);

        // populate client filter
        var client_filter = new Array();
        $.each($(".client-filter"), function (key, elm) {
            if ($(elm).find("select[name='ReportWizardForm[client_filter_field]']").val()) {
                var json = {
                    "id": $(elm).find("select[name='ReportWizardForm[client_filter_field]']").val(),
                    "op": $(elm).find("input[name='ReportWizardForm[client_filter_operator]']").val()
                };
                client_filter.push(json);
            }
        });
        console.log(client_filter);

        // populate order field
        var elm = $("#step_field_order").find('input[type=hidden].selected-field');
        var field_order = new Array();
        $.each(elm, function (key, val) {
            field_order.push(parseInt($(val).val()));
        });

        var post_json = {
            report_name: $("input[name='ReportWizardForm[report_name]']").val(),
            report_description: $("textarea[name='ReportWizardForm[report_description]']").val(),
            field_order: field_order,
            limit_per_page: limit_row,
            filter: adv_filter,
            client_filter: client_filter,
            sorting_order: sorting_order
        };
        console.log(post_json);

        $.ajax({
            url: '/report/save',
            data: post_json,
            type: 'POST',
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
            }
        });
    });
});