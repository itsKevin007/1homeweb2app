var my_handlers = {
    // ... First and Second sets handlers

    // fill province for the first region
    fill_provinces: function() {
        var region_code = $(this).val();
        var region_text = $(this).find("option:selected").text();
        let region_input = $('#region-text');
        region_input.val(region_text);

        $('#province-text').val('');
        $('#city-text').val('');
        $('#barangay-text').val('');

        let dropdown = $('#province');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose State/Province</option>');

        let city = $('#city');
        city.empty();
        city.append('<option selected="true" disabled></option>');

        let barangay = $('#barangay');
        barangay.empty();
        barangay.append('<option selected="true" disabled></option>');

        var url = 'ph-json/province.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.region_code == region_code;
            });
            result.sort(function(a, b) {
                return a.province_name.localeCompare(b.province_name);
            });
            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
            });
        });
    },

    // fill city for the first province
    fill_cities: function() {
        var province_code = $(this).val();
        var province_text = $(this).find("option:selected").text();
        let province_input = $('#province-text');
        province_input.val(province_text);

        $('#city-text').val('');
        $('#barangay-text').val('');

        let dropdown = $('#city');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose city/municipality</option>');

        let barangay = $('#barangay');
        barangay.empty();
        barangay.append('<option selected="true" disabled></option>');

        var url = 'ph-json/city.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.province_code == province_code;
            });
            result.sort(function(a, b) {
                return a.city_name.localeCompare(b.city_name);
            });
            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.city_code).text(entry.city_name));
            });
        });
    },

    // fill barangay for the first city
    fill_barangays: function() {
        var city_code = $(this).val();
        var city_text = $(this).find("option:selected").text();
        let city_input = $('#city-text');
        city_input.val(city_text);

        $('#barangay-text').val('');

        let dropdown = $('#barangay');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose barangay</option>');

        var url = 'ph-json/barangay.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.city_code == city_code;
            });
            result.sort(function(a, b) {
                return a.brgy_name.localeCompare(b.brgy_name);
            });
            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
            });
        });
    },

    // update barangay text input for the first set
    onchange_barangay: function() {
        var barangay_text = $(this).find("option:selected").text();
        let barangay_input = $('#barangay-text');
        barangay_input.val(barangay_text);
    },

    // fill province for the second region
    fill_provinces2: function() {
        var region_code = $(this).val();
        var region_text = $(this).find("option:selected").text();
        let region_input = $('#region-text2');
        region_input.val(region_text);

        $('#province-text2').val('');
        $('#city-text2').val('');
        $('#barangay-text2').val('');

        let dropdown = $('#province2');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose State/Province</option>');

        let city = $('#city2');
        city.empty();
        city.append('<option selected="true" disabled></option>');

        let barangay = $('#barangay2');
        barangay.empty();
        barangay.append('<option selected="true" disabled></option>');

        var url = 'ph-json/province.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.region_code == region_code;
            });
            result.sort(function(a, b) {
                return a.province_name.localeCompare(b.province_name);
            });
            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
            });
        });
    },

    // fill city for the second province
    fill_cities2: function() {
        // Similar to fill_cities, but for the second set
        var province_code = $(this).val();
        var province_text = $(this).find("option:selected").text();
        let province_input = $('#province-text2');
        province_input.val(province_text);

        $('#city-text2').val('');
        $('#barangay-text2').val('');

        let dropdown = $('#city2');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose city/municipality</option>');

        let barangay = $('#barangay2');
        barangay.empty();
        barangay.append('<option selected="true" disabled></option>');

        var url = 'ph-json/city.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.province_code == province_code;
            });
            result.sort(function(a, b) {
                return a.city_name.localeCompare(b.city_name);
            });
            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.city_code).text(entry.city_name));
            });
        });
    },

    // fill barangay for the second city
    fill_barangays2: function() {
        // Similar to fill_barangays, but for the second set
        var city_code = $(this).val();
        var city_text = $(this).find("option:selected").text();
        let city_input = $('#city-text2');
        city_input.val(city_text);

        $('#barangay-text2').val('');

        let dropdown = $('#barangay2');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose barangay</option>');

        var url = 'ph-json/barangay.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.city_code == city_code;
            });
            result.sort(function(a, b) {
                return a.brgy_name.localeCompare(b.brgy_name);
            });
            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
            });
        });
    },

    // update barangay text input for second set
    onchange_barangay2: function() {
        // Similar to onchange_barangay, but for the second set
        var barangay_text = $(this).find("option:selected").text();
        let barangay_input = $('#barangay-text2');
        barangay_input.val(barangay_text);
    },

    // fill province for the third region
    fill_provinces3: function() {
        var region_code = $(this).val();
        var region_text = $(this).find("option:selected").text();
        let region_input = $('#region-text3');
        region_input.val(region_text);

        $('#province-text3').val('');
        $('#city-text3').val('');
        $('#barangay-text3').val('');

        let dropdown = $('#province3');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose State/Province</option>');

        let city = $('#city3');
        city.empty();
        city.append('<option selected="true" disabled></option>');

        let barangay = $('#barangay3');
        barangay.empty();
        barangay.append('<option selected="true" disabled></option>');

        var url = 'ph-json/province.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.region_code == region_code;
            });
            result.sort(function(a, b) {
                return a.province_name.localeCompare(b.province_name);
            });
            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.province_code).text(entry.province_name));
            });
        });
    },

    // fill city for the third province
    fill_cities3: function() {
        // Similar to fill_cities3, but for the third set
        var province_code = $(this).val();
        var province_text = $(this).find("option:selected").text();
        let province_input = $('#province-text3');
        province_input.val(province_text);

        $('#city-text3').val('');
        $('#barangay-text3').val('');

        let dropdown = $('#city3');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose city/municipality</option>');

        let barangay = $('#barangay3');
        barangay.empty();
        barangay.append('<option selected="true" disabled></option>');

        var url = 'ph-json/city.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.province_code == province_code;
            });
            result.sort(function(a, b) {
                return a.city_name.localeCompare(b.city_name);
            });
            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.city_code).text(entry.city_name));
            });
        });
    },

    // fill barangay for the third city
    fill_barangays3: function() {
        // Similar to fill_barangays3, but for the third set
        var city_code = $(this).val();
        var city_text = $(this).find("option:selected").text();
        let city_input = $('#city-text3');
        city_input.val(city_text);

        $('#barangay-text3').val('');

        let dropdown = $('#barangay3');
        dropdown.empty();
        dropdown.append('<option selected="true" disabled>Choose barangay</option>');

        var url = 'ph-json/barangay.json';
        $.getJSON(url, function(data) {
            var result = data.filter(function(value) {
                return value.city_code == city_code;
            });
            result.sort(function(a, b) {
                return a.brgy_name.localeCompare(b.brgy_name);
            });
            $.each(result, function(key, entry) {
                dropdown.append($('<option></option>').attr('value', entry.brgy_code).text(entry.brgy_name));
            });
        });
    },

    // update barangay text input for third set
    onchange_barangay3: function() {
        // Similar to onchange_barangay3, but for the third set
        var barangay_text = $(this).find("option:selected").text();
        let barangay_input = $('#barangay-text3');
        barangay_input.val(barangay_text);
    },
};

// Initialize for all three sets of dropdowns
$(function() {
    // First set
    $('#region').on('change', my_handlers.fill_provinces);
    $('#province').on('change', my_handlers.fill_cities);
    $('#city').on('change', my_handlers.fill_barangays);
    $('#barangay').on('change', my_handlers.onchange_barangay);

    // Second set
    $('#region2').on('change', my_handlers.fill_provinces2);
    $('#province2').on('change', my_handlers.fill_cities2);
    $('#city2').on('change', my_handlers.fill_barangays2);
    $('#barangay2').on('change', my_handlers.onchange_barangay2);

    // Third set
    $('#region3').on('change', my_handlers.fill_provinces3);
    $('#province3').on('change', my_handlers.fill_cities3);
    $('#city3').on('change', my_handlers.fill_barangays3);
    $('#barangay3').on('change', my_handlers.onchange_barangay3);

    // Load regions for all three dropdowns
    let dropdown1 = $('#region');
    let dropdown2 = $('#region2');
    let dropdown3 = $('#region3');
    const url = 'ph-json/region.json';

    $.getJSON(url, function(data) {
        $.each(data, function(key, entry) {
            dropdown1.append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
            dropdown2.append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
            dropdown3.append($('<option></option>').attr('value', entry.region_code).text(entry.region_name));
        });
    });
});
