<?php
/**
 * Created by PhpStorm.
 * User: hellenmicky
 * Date: 06.03.2019
 * Time: 15:44
 */

namespace APN\YourServiceNamespace;

use APN\YourInterfaceNamespace\ResponseTransformerInterface;

/**
 * Class ResponseTransformerService
 * @package App\src\Services
 */
class ResponseTransformerService implements ResponseTransformerInterface
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
    public function parse($data): array
    {
        return [
            'name'    => [
                'firstName' => $data['first_name'],
                'lastName'  => $data['last_name']
            ],
            'company' => $data['company']['name'],
            'email'   => $data['email'],
            'phone'   => $data['mobile_number'],
            'address' => [
                'country' => $data['country'],
                'state'   => $data['state'],
                'city'    => $data['city'],
                'address' => $data['address'],
                'zipcode' => $data['zipcode']
            ]
        ];
    }
}