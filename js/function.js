$(".nav-link").click(function () {

    var data_id = $(this).attr("data-id");

    if (data_id !== '#') {
        localStorage.setItem('list', '#' + data_id);
    } else {
        return true;
    }

    if (data_id === "faculty" || data_id === "faculty-subject") {
        localStorage.setItem('open', '#menu-open-faculty');
        localStorage.setItem('link', '#link-faculty');
    } else if (data_id === "students" || data_id === "student-subject") {
        localStorage.setItem('open', '#menu-open-student');
        localStorage.setItem('link', '#link-students');
    } else {
        localStorage.setItem('open', '');
        localStorage.setItem('link', '');
    }

});


$(function () {

    var list = localStorage.getItem('list');
    var open = localStorage.getItem('open');
    var link = localStorage.getItem('link');
    var avatar_value = $('input[name="image"]').val();

    //Select 1
    var get_select_1 = $('#get_select_1').val();
    $('#select_1').change(function () {
        var value = $(this).val();
        $('#get_select_1').val(value);
    });
    $('#select_1').val(get_select_1);

    //Select 2
    var get_select_2 = $('#get_select_2').val();
    $('#select_2').change(function () {
        var value = $(this).val();
        $('#get_select_2').val(value);
    });
    $('#select_2').val(get_select_2);

    //Select 3
    var get_select_3 = $('#get_select_3').val();
    $('#select_3').change(function () {
        var value = $(this).val();
        $('#get_select_3').val(value);
    });
    $('#select_3').val(get_select_3);

    //Select 4
    var get_select_4 = $('#get_select_4').val();
    $('#select_4').change(function () {
        var value = $(this).val();
        $('#get_select_4').val(value);
    });
    $('#select_4').val(get_select_4);

    //Select Subject Code
    var get_select_subject = $('#get_select_subject').val();
    $('#select_subject').change(function () {
        var value = $(this).val();
        $('#get_select_subject').val(value);
    });
    $('#select_subject').val(get_select_subject);
    
    $(':input[type="submit"]').click(function () {
        $(':input[type="submit"]').addClass('disabled');
        $('span.d-none').removeClass('d-none');
    });

    $(':input[type="submit"]').click(function () {
        $(':input[type="submit"]').addClass('disabled');
        $('span.d-none').removeClass('d-none');
    });

    $('a.btn-info').each(function () {
        $(this).on('click', function () {
            $(this).addClass('disabled');
            $(this).find('span.d-none').removeClass('d-none');
            $(this).find('i').addClass('d-none');
        });
    });

    $('#complete').click(function () {
        $(this).addClass('disabled');
        $(this).find('span.d-none').removeClass('d-none');
    });

    $('#logout').click(function () {
        localStorage.clear();
    });

    $('.btn-sm').click(function () {
        var data = $(this).attr('data-id');
        $('#delete-id').val(data);
    });

    //Change Subject Code
    $('#select_subject').on('change', function () {
        var url = window.location.href;
        var newUrl = url.slice(0, url.lastIndexOf("/", url.lastIndexOf("/") - 1));
        var data_1 = $('select option:selected').attr('data-object-1');
        var data_2 = $('select option:selected').attr('data-object-2');
        var dataUrl = newUrl + "/" + data_1 + "/" + data_2;
        window.location.href = dataUrl;
    });

    //Select Student Subject
    $('#select_student_subject').on('click', function () {
        var url = window.location.href;
        var select_val = $('select').val();
        var select_id = $('select option:selected').attr('data-id');
        if (select_val && select_id) { 
            if (url.indexOf(select_val) === -1 && url.indexOf(select_id) === -1) {
                var dataUrl = url + "/" + select_val + "/" + select_id;
            } else {
                var dataUrl = url.split('/').slice(0, -2).join('/') + "/" + select_val + "/" + select_id;
            }
            $(this).addClass('disabled');
            $('#select_spin').removeClass('d-none');
            window.location.href = dataUrl;
        } else {
            $('#select_1').focus();
        }
    });

    //Print Event
    $('#btn_print').on('click', function() {
        $(this).addClass('disabled');
        $('#print_spin').removeClass('d-none');
    });

    $('#generate').bind("click", function () {
        var random1 = Math.floor(Math.random() * 90000) + 10000;
        var random2 = Math.floor(Math.random() * 90000) + 10000;
        var random3 = Math.floor(Math.random() * 90000) + 10000;
        var random_generate = random1 + '-' + random2 + '-' + random3;
        $(':input[name="id_number"]').val(random_generate);
    });

    $('#toggle_password').bind("click", function () {
        var password = $('#password');
        var visibility = $('#visibility');

        if (password.attr('type') === "password") {
            password.attr('type', 'text');
            visibility.removeClass("fas fa-eye-slash");
            visibility.addClass("fas fa-eye");
        } else {
            password.attr('type', 'password');
            visibility.removeClass("fas fa-eye");
            visibility.addClass("fas fa-eye-slash");
        }
    });

    $('#confirm_toggle_password').bind("click", function () {
        var password = $('#confirm_password');
        var visibility = $('#confirm_visibility');
        if (password.attr('type') === "password") {
            password.attr('type', 'text');
            visibility.removeClass("fas fa-eye-slash");
            visibility.addClass("fas fa-eye");
        } else {
            password.attr('type', 'password');
            visibility.removeClass("fas fa-eye");
            visibility.addClass("fas fa-eye-slash");
        }
    });

    $('#btn-off').click(function() {

        $('input[name="toggle-password"]').val('');
        $(this).addClass('btn-info');
        $(this).removeClass('btn-secondary');
        $('#btn-on').addClass('btn-secondary');
        $('#btn-on').removeClass('btn-info');
        $('#password').prop('disabled', true);
        $('#confirm_password').prop('disabled', true);
        $('#password').val('');
        $('#confirm_password').val('');

    });

    $('#btn-on').click(function() {

        var value = $(this).val()
        $('input[name="toggle-password"]').val(value);
        $(this).addClass('btn-info');
        $(this).removeClass('btn-secondary');
        $('#btn-off').addClass('btn-secondary');
        $('#btn-off').removeClass('btn-info');
        $('#password').prop('disabled', false);
        $('#confirm_password').prop('disabled', false);

    });

    //Avatar Icons
    $('button.position-relative').click(function() {
        var value = $(this).val();
        $('#profile-image').val(value);
        $('.avatar-check').addClass('d-none');
        $(this).find('.avatar-check').removeClass('d-none');
    });

    //Confirm Avatar
    $('#avatar-confirm').click(function() {
        var url = window.location.origin + window.location.pathname.replace(/\/[^\/]*$/, '') + '/assets/dist/img/';
        var value = $('#profile-image').val();
        var newUrl = 'url("' + url + value + '")';
        $('.avatar-profile').css('background-image', newUrl);
        $('input[name="image"]').val(value);
        $('#profileImage').modal('hide');
    });

    if (list || open || link) {
        $(list).addClass('active');
        $(link).addClass('active');
        $(open).addClass('menu-open');
    } else {
        $('#default_url').addClass('active');
    }

    $('#datatable').DataTable();
    $('#datatable-1').DataTable({
        lengthMenu: [5],
        info: false
    });
    $('#datatable-2').DataTable({
        lengthMenu: [5],
        info: false
    });

    //Select Specific Subject Type
    var get_select_subject_type = [];
    var get_select_subject_type_element = $('#get_select_subject_type');
    if (get_select_subject_type_element.length > 0) {
    get_select_subject_type = get_select_subject_type_element.val().split(',');
    }
    $('#select_subject_type').change(function () {
    var value = $(this).val();
    $('#get_select_subject_type').val(value);
    });
    $('#select_subject_type').val(get_select_subject_type);

    //Get Avatar Value
    if(avatar_value !== '') {
        var url = window.location.origin + window.location.pathname.replace(/\/[^\/]*$/, '') + '/assets/dist/img/';
        var newUrl = 'url("' + url + avatar_value + '")';
        $('.avatar-profile').css('background-image', newUrl);
    } else {
        return false;
    }

    $('.selectpicker').selectpicker('render');

    $.ajax({
        url: window.location.origin + window.location.pathname.replace(/\/[^\/]*$/, '') + "/barchart",
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        success: function(result) {

            if(Array.isArray(result)) {

                const dataBSCS_1 = result[0].count;
                const dataBSIT_1 = result[1].count;
                const dataBSCS_2 = result[2].count;
                const dataBSIT_2 = result[3].count;
                const dataBSCS_3 = result[4].count;
                const dataBSIT_3 = result[5].count;
                const dataBSCS_4 = result[6].count;
                const dataBSIT_4 = result[7].count;
                const dataBSCS_5 = result[8].count;
                const dataBSIT_5 = result[9].count;
                const dataBSCS_6 = result[10].count;
                const dataBSIT_6 = result[11].count;
                const dataBSCS_7 = result[12].count;
                const dataBSIT_7 = result[13].count;
                const dataBSCS_8 = result[14].count;
                const dataBSIT_8 = result[15].count;
                const dataBSCS_9 = result[16].count;
                const dataBSIT_9 = result[17].count;
                const dataBSCS_10 = 0;
                const dataBSIT_10 = result[18].count;
                const dataBSCS_11 = result[19].count;
                const dataBSIT_11 = result[20].count;
                const dataBSCS_12 = result[21].count;
                const dataBSIT_12 = result[22].count;
                const dataBSCS_13 = result[23].count;
                const dataBSIT_13 = result[24].count;
                const dataBSCS_14 = result[25].count;
                const dataBSIT_14 = result[26].count;
                const dataBSCS_15 = result[27].count;
                const dataBSIT_15 = result[28].count;
                const dataBSCS_16 = result[29].count;
                const dataBSIT_16 = result[30].count;
                const dataBSCS_17 = result[31].count;
                const dataBSIT_17 = result[32].count;
                const dataBSCS_18 = result[33].count;
                const dataBSIT_18 = result[34].count;

                const areaChartData = {
                    labels: [...new Set(result.map(row => row.subject_type))],
                    datasets: [
                        {
                            label: 'BSIT',
                            backgroundColor: 'rgba(60,141,188,0.9)',
                            borderColor: 'rgba(60,141,188,0.8)',
                            pointRadius: 0,
                            pointBackgroundColor: '#3b8bba',
                            pointHoverBackgroundColor: 'rgba(60,141,188,1)',
                            pointHoverBorderColor: '#fff',
                            data: [
                                dataBSIT_1,dataBSIT_2,dataBSIT_3,dataBSIT_4,dataBSIT_5,dataBSIT_6,dataBSIT_7,dataBSIT_8,dataBSIT_9,dataBSIT_10,dataBSIT_11,dataBSIT_12,dataBSIT_13,dataBSIT_14,dataBSIT_15,dataBSIT_16,dataBSIT_17,dataBSIT_18,
                            ],
                        },
                        {
                            label: 'BSCS',
                            backgroundColor: 'rgba(210, 214, 222, 1)',
                            borderColor: 'rgba(210, 214, 222, 1)',
                            pointRadius: 0,
                            pointBackgroundColor: 'rgba(210, 214, 222, 1)',
                            pointHoverBackgroundColor: '#fff',
                            pointHoverBorderColor: 'rgba(220,220,220,1)',
                            data: [
                                dataBSCS_1,dataBSCS_2,dataBSCS_3,dataBSCS_4,dataBSCS_5,dataBSCS_6,dataBSCS_7,dataBSCS_8,dataBSCS_9,dataBSCS_10,dataBSCS_11,dataBSCS_12,dataBSCS_13,dataBSCS_14,dataBSCS_15,dataBSCS_16,dataBSCS_17,dataBSCS_18
                            ],
                        },
                    ],
                };
                
                const barChartCanvas = document.querySelector('#barChart').getContext('2d');
                const barChartData = {...areaChartData};
                [barChartData.datasets[0], barChartData.datasets[1]] = [barChartData.datasets[1], barChartData.datasets[0]];

                const barChartOptions = {
                    responsive: true,
                    maintainAspectRatio: false,
                    datasetFill: false
                };

                new Chart(barChartCanvas, {
                    type: 'bar',
                    data: barChartData,
                    options: barChartOptions
                });

            } else {

                return false;

            }

        }
    });

});