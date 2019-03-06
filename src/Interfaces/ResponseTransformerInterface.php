<?php
/**
 * Created by PhpStorm.
 * User: hellenmicky
 * Date: 06.03.2019
 * Time: 15:47
 */

namespace APN\YourInterfaceNamespace;

/**
 * Interface ResponseTransformerInterface
 * @package App\src\Interfaces
 */
interface ResponseTransformerInterface
{
    /**
     * Method is responsible for transforming the data.
     *
     * e.g return ['FirstName' => $data['first_name'],...];
     * e.g return $data;
     *
     * @param $data
     * @return array
     */
    public function parse($data): array;
}