<?php
/**
 * Created by.
 * User: DIFF
 * DATE: 2022/6/20
 * TIME: 19:46
 */

namespace App\Utils\Packer;

class MsgpackPacker
{
    public function pack($data): string
    {
        return msgpack_pack($data);
    }

    public function unpack(string $data)
    {
        return msgpack_unpack($data);
    }

}