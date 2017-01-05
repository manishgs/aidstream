/*
 Default JS file for Lite Version - [Doesn't need to be this way. Just for bootstrapping purposes]
 */

var Lite = {
    updatePermission: function () {
        $('table tbody tr td').delegate('#permission', 'change', function (e) {
            var user_id = $(this).closest('tr').find('#user_id').val();
            var username = $(this).closest('tr').find('#name').html();
            var permission = $(this).val();
            var permission_text = $(':selected', this).text();
            $('#response').addClass('hidden');
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('[name="_token"]').val()},
                url: '/lite/users/update-permission/' + user_id,
                data: {permission: permission},
                type: 'POST',
                beforeSend: function () {
                    $('body').append('<div class="loader">.....</div>');
                },
                complete: function () {
                    $('body > .loader').addClass('hidden').remove();
                },
                success: function (data) {
                    if (data == 'success') {
                        $('.alert-success').addClass('hidden');
                        $('#success').removeClass('hidden').html(permission_text + ' level permission has been given to ' + username);
                    } else {
                        $('.alert-danger').addClass('hidden');
                        $('#error').removeClass('hidden').html('Failed to update permission for ' + username);
                    }

                }
            });
        });
    }
};


