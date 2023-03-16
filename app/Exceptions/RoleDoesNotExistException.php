<?php
namespace App\Exceptions;
use Exception;

/**
 * Roleがtableに存在しない際に発生するException
 *
 */
class RoleDoesNotExistException extends Exception {
    protected $message = "A role id you selected does not exist in the table.";
}
