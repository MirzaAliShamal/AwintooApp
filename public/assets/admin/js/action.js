$(document).ready(function(){
    // CSRF Token
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    // message methods
    function messageHide(){
        $('.message').animate({ opacity: 0,top: '0px' }, 'slow');
        setTimeout(function(){ $(".message").html(''); }, 2000);
    }
    messageHide();

    function messageShow(data){
        $(".message").html(data);
        $('.message').animate({ opacity: 1,top: '60px' }, 'slow');

        setTimeout(function(){ messageHide() }, 3000);
    }

    // Save Form
    $('.saveForm').submit(function(e) {
        e.preventDefault();

        var formElement = $(this);
        var storeUrl = formElement.data('storeurl');
        $(".saveForm input, .saveForm textarea, .saveForm select").on('input', function() {
            var fieldId = $(this).attr('id');
            $(this).removeClass('is-invalid');
            $('[data-for="' + fieldId + '"]').html('');
        });

        $('.saveForm input[readonly]').on('focus', function() {
            var fieldId = $(this).attr('id');
            $(this).removeClass('is-invalid');
            $('[data-for="' + fieldId + '"]').html('');
        });

        $('button[type=submit]').prop('disabled', true);
        $.ajax({
            url: storeUrl,
            type: 'post',
            data: new FormData(formElement[0]),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                $('button[type=submit]').prop('disabled', false);

                if (data['status'] == true) {
                    formElement[0].reset();
                    messageShow("<div class='alert alert-success'>"+data['message']+"</div>");
                    if(data['redirect']) {
                        setTimeout(function(){
                            window.location.href = data.redirect;
                        }, 1000);
                    }

                } else {
                    messageShow("<div class='alert alert-danger'>"+data['message']+"</div>");
                    $.each(data['errors'], function(key, value) {
                        $('#' + key)
                        .addClass('is-invalid')
                        .siblings('p')
                        .addClass('invalid-feedback')
                        .html(value);
                    });
                   
                }
            },
            error: function(jqXHR, exception) {
                console.log("Something went wrong");
            }
        });
    });

    // Delete
    $('#datatable').on('click', '.deleteAction', function(e) {
        e.preventDefault();

        var deleteRoute = $(this).data('destroy');
        var row = $(this).closest('tr');

        if (confirm("Are you sure?")) {
            $.ajax({
                url: deleteRoute,
                type: 'DELETE',
                dataType: 'json',
                success: function(data) {
                    if (data['status'] == true) {
                        if (data['redirect']) {
                            window.location.href = data['redirect'];
                        }
                        messageShow("<div class='alert alert-success'>" + data['message'] + "</div>");
                        setTimeout(function() {
                            row.remove();
                        }, 900);
                    } else {
                        messageShow("<div class='alert alert-danger'>" + data['message'] + "</div>");
                        if (data['redirect']) {
                            setTimeout(function() {
                                window.location.href = data['redirect'];
                            }, 900);
                        }
                    }
                }
            });
        }
    });

    $('#client_id').change(function() {
        var clientId = $(this).val();

        if (clientId) {
            $.ajax({
                url: '/admin/client-info/' + clientId,
                type: 'GET',
                success: function(response) {
                    if (response.status) {
                        $('#client_name').val(response.client.full_name);
                        $('#passport_number').val(response.client.passport_number);
                        $('#issue_date').val(response.client.issue_date);
                        $('#expiry_date').val(response.client.expiry_date);
                        $('#dob').val(response.client.dob);
                        $('#job_id').val(response.client.job_id);
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error fetching client information.');
                }
            });
        } else {
            $('#full_name').val('');
        }
    });
});
