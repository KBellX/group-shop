<?php

namespace app\api\service;

use app\api\model\Address as AddressModel;
use app\libs\exception\UserException;

class Address
{
    public function add($data)
    {
        $codes = $this->buildCode($data['code']);
        $data = array_merge($data, $codes);
        unset($data['code']);
        $address = new AddressModel();
        $address->save($data);
    }

    public function edit($id, $userId, $data)
    {
        $address = AddressModel::findByIdAndUserId($id, $userId);
        if (!$address) {
            throw new UserException('地址不存在');
        }
        $codes = $this->buildCode($data['code']);
        $data = array_merge($data, $codes);
        unset($data['code']);
        $address->save($data);
    }

    private function buildCode($code)
    {
        $provinceCode = "{$code[0]}{$code[1]}0000";
        $cityCode = "{$code[0]}{$code[1]}{$code[2]}{$code[3]}00";
        $areaCode = $code;

        return [
            'p_code' => $provinceCode,
            'c_code' => $cityCode,
            'a_code' => $areaCode,
        ];
    }
}
