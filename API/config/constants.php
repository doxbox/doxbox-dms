<?php

define('API_VERSION', '1.08');

define('OWL_ERROR',                  '0000');  // Owl printError Function returned message
define('SUCCESS',                    '0001');

define('ERROR_MISSING_API_KEY',      '0010');
define('ERROR_WRONG_API_IP',         '0011');
define('ERROR_ACCESS_DENIED',        '0012');

define('AUTH_FAILED',                '0020');
define('AUTH_USER_DISABLED',         '0021');

define('SESS_EXPIRED',               '0030');
define('SESS_IN_USE',                '0031');
define('SESS_NOT_EXIST',             '0032');
define('SESS_INVALID',               '0033');

define('UPLOAD_FILE_EXIST',          '0040');
define('UPLOAD_PERM_DENIED',         '0041');
define('UPLOAD_NO_DEST',             '0042');

define('FOLDER_CREATE_PERM_DENIED',  '0050');
define('FOLDER_CREATE_EXISTS',       '0051');
define('FOLDER_CREATE_NAME_EMPTY',   '0052');
define('FOLDER_CREATE_RESERVED_NAME','0053');
define('FOLDER_CREATE_FAILED',       '0054');
define('FOLDER_CREATE_NO_DEST',      '0055');

define('ADDUSER_EXISTS',             '0060');

define('ADDGROUP_EXISTS',            '0070');

define('QUOTA_EXCCEDED',             '0080');

define('UPDATE_PERM_DENIED',         '0090');
define('UPDATE_DIFFERENT_EXTENSIONS','0091');
define('UPDATE_BACKUP_CREATE_FAILED','0092');
define('UPDATE_FILE_BACKUP_FAILED',  '0093');

define('DELETE_FILE_NOT_EXISTS',     '0100');

define('DWNL_FILE_PERM_DENIED',      '0110');
define('DWNL_FILE_MISSING',          '0111');

define('UNKOWN_ERROR',               '9980');
define('DATABASE_ERROR',             '9990');
define('FATAL_ERROR',                '9999');
