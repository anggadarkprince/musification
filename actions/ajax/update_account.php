<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '/../../vendor/autoload.php';
    require_once __DIR__ . '/../../support/helper.php';

    $session = new \App\Session();
    $account = new \App\Account();
    $validator = new \App\Validator();


    $id = $session->getData('auth.id');
    $name = get_input('name');
    $username = get_input('username');
    $email = get_input('email');
    $password = get_input('password');
    $newPassword = get_input('new_password');
    $confirmPassword = get_input('confirm_password');

    $validate = $validator->validate([
        'name' => 'required|maxLength[50]',
        'email' => 'required|email|maxLength[50]',
        'username' => 'required|username|maxLength[50]|unique[users.username,' . $id . ']',
        'password' => 'required',
        'new_password' => 'maxLength[50]',
        'confirm_password' => 'confirm[new_password]',
    ], [], false);

    $validationErrors = $validator->getValidationErrors();

    $accountObj = $account->getUser($id);

    if (!password_verify($password, $accountObj['password'])) {
        $validationErrors['password'][] = 'The password is mismatch with current password';
    }

    header('Content-Type: application/json');

    if (empty($validationErrors)) {
        if (!empty($newPassword) && ($newPassword == $confirmPassword)) {
            $password = password_hash($newPassword, CRYPT_BLOWFISH);
        } else {
            $password = password_hash($password, CRYPT_BLOWFISH);
        }
        echo json_encode([
            'result' => $account->updateUser($id, $name, $username, $email, $password)
        ]);

    } else {
        echo json_encode([
            'result' => false,
            'errors' => $validationErrors
        ]);
    }

}
