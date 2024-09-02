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
        $('#loading-screen').fadeIn();
        $.ajax({
            url: storeUrl,
            type: 'post',
            data: new FormData(formElement[0]),
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(data) {
                $('button[type=submit]').prop('disabled', false);
                $('#loading-screen').fadeOut();
                if (data['status'] == true) {
                    formElement[0].reset();
                    messageShow("<div class='alert alert-success'>"+data['message']+"</div>");
                    if(data['redirect']) {
                        setTimeout(function(){
                            window.location.href = data.redirect;
                        }, 1000);
                    }

                } else {
                    $('#loading-screen').fadeOut();
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
                $('#loading-screen').fadeOut();
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

    // Delete Document
    $('.delete-doc').click(function(e) {
        e.preventDefault();
        var deleteRoute = $(this).data('delete-doc');
        if (confirm("Are you sure you want to delete this document?")) {
            $.ajax({
                url: deleteRoute,
                type: 'DELETE',
                success: function(response) {
                    if (response.status === true) {
                        messageShow("<div class='alert alert-success'>" + response['message'] + "</div>");
                        window.location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr) {
                    alert('An error occurred while deleting the document.');
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
                        $('#job_name').val(response.client.job.job_name);
                        $('#price').val(response.client.job.price);
                    } else {
                        alert(response.message);
                    }
                },
                error: function() {
                    alert('Error fetching client information.');
                }
            });
        } else {
            $('#client_name').val('');
        }
    });

    $('.update-status').click(function(e) {
        e.preventDefault();
        var updateRoute = $(this).data('status');
        $('#loading-screen').fadeIn();
        $.ajax({
            url: updateRoute,
            type: 'GET',
            success: function(response) {
                if (response['status'] == true) {
                    $('#loading-screen').fadeOut();
                    window.location.reload();
                    messageShow("<div class='alert alert-success'>" + response['message'] + "</div>");
                }
            },
            error: function(xhr) {
                $('#loading-screen').fadeOut();
                alert('An error occurred while updating the status.');
            }
        });
    });

    // Multi-Select
    $('#select-all').on('click', function() {
        $('.student-checkbox').prop('checked', this.checked);
    });

    $('.send-notification').on('click', function(e) {
        e.preventDefault();
        var mailRoute = $(this).data('mail');
        let selectedStudents = [];
        $('.student-checkbox:checked').each(function() {
            selectedStudents.push($(this).val());
        });
        $('#loading-screen').fadeIn();
        if (confirm("Are you sure you want to send mail?")) {
            if (selectedStudents.length > 0) {
                $.ajax({
                    url: mailRoute,
                    type: 'POST',
                    data: { student_ids: selectedStudents },
                    success: function(response) {
                        messageShow("<div class='alert alert-success'>" + response['message'] + "</div>");
                        $('#loading-screen').fadeOut();
                    },
                    error: function(response) {
                    $('#loading-screen').fadeOut();
                        alert('Failed to send notifications.');
                    }
                });
            } else {
                $('#loading-screen').fadeOut();
                alert('Please select at least one student.');
            }
        } else {
            $('#loading-screen').fadeOut();
        }
    });
});
