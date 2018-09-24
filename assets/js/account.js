$(function () {
    $(document).on('click', '#btn-update-account', function () {
        let form = $('#form-account');
        let buttonUpdate = $(this);

        let data = {
            name: form.find('#name').val(),
            username: form.find('#username').val(),
            email: form.find('#email').val(),
            password: form.find('#password').val(),
            new_password: form.find('#new_password').val(),
            confirm_password: form.find('#confirm_password').val(),
        };

        form.find('.input-text-error').remove();
        form.find('.alert').remove();

        buttonUpdate.prop('disabled', true);
        $.post('actions/ajax/update_account.php', data, function (data) {
            buttonUpdate.prop('disabled', false);
            if (data.result) {
                let alert = '<div class="alert alert-success"><p>User account is updated</p></div>';
                form.prepend(alert);

                form.find('#password').val('');
                form.find('#new_password').val('');
                form.find('#confirm_password').val('');
                $('.view-container').scrollTop(0);
            } else {
                if (data.errors) {
                    let errors = data.errors;

                    form.find('.input-text-error').remove();
                    for (let field in errors) {
                        if (errors.hasOwnProperty(field)) {
                            let inputGroup = form.find('#' + field).closest('.input-group');
                            inputGroup.append('<p class="input-text-error">' + errors[field][0] + '</p>');
                        }
                    }
                }
            }
        });
    });
});