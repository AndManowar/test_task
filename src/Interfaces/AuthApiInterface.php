<?php
/**
 * Created by PhpStorm.
 * User: hellenmicky
 * Date: 06.03.2019
 * Time: 14:15
 */

namespace APN\YourInterfaceNamespace;

/**
 * Interface AuthApiInterface
 * @package App\scr\Interfaces
 */
interface AuthApiInterface
{
    /**
     * Implement authentication logic to connect to the third party
     * API
     */
    public function authenticate();
}