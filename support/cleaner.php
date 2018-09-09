<?php
$session->clearFlashData(App\Session::KEY_APP_FLASH);
$session->clearFlashData(App\Session::KEY_VALIDATION_FLASH);
$session->clearOldData();