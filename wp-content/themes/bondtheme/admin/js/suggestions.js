jQuery(function ($) {
    $("#titlewrap").append("<div id='suggestions'></div>");
    $("#title").on('keyup', function () {
        var title_value = $("#title").val();
        $.getJSON(
            'https://autocomplete.geocoder.api.here.com/6.2/suggest.json?app_id=KngCq2F5ZiDAoC5mHcOf&app_code=B9eBCS_ZNlw3uV-F8JilqQ&country=GBR&query=' + title_value,
            function (response) {
             var suggestions = response.suggestions, suggestions_cities = [], suggestions_html = '';
             for ( var n in suggestions ) {
                 if ( suggestions[n].address.city && suggestions[n].address.city.startsWith(title_value) ) {
                     suggestions_cities.push(suggestions[n].address.city);
                 }
             }
             var suggestions_unique = suggestions_cities.filter(function (item, i, arr) {
                 return i == arr.indexOf(item);
             });

             for ( var n in suggestions_unique) {
                 suggestions_html += suggestions_unique[n] ? "<span>" + suggestions_unique[n] + "</span>" : '';
             }
                $("#suggestions").html(suggestions_html);
            }
            );
    });

    $("#titlewrap").on("click", 'span', function () {
        $("#title").val($(this).html());
        $("#suggestions").html("");
    });
    $('.acf-input-wrap input[type=text]').on('change', function () {
        $(this).each(function () {
            let old_val = $(this).val();
            $(this).val(old_val.trim());
        });
    });
});