$(function () {
    var loginForm = $('#login-form');
    var registerForm = $('#register-form');

    $('.link-login a').on('click', function (e) {
        e.preventDefault();
        loginForm.show();
        registerForm.hide();
    });

    $('.link-register a').on('click', function (e) {
        e.preventDefault();
        registerForm.show();
        loginForm.hide();
    });
});