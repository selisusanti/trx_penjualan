<?php

namespace App\Http\Helpers;

class GlobalHelper 
{
    public static function getResourceError($resource_lang_key, $params = [], $code = 500, $status_code = 500)
    {
        $result = [
            'message'       => $resource_lang_key,
            'code'          => $code,
            'status_code'   => $status_code];
        
        $resource_message = trans($resource_lang_key, $params);
        if (!empty($resource_message))
        {
            if (is_array($resource_message))
            {
                if (array_key_exists('message', $resource_message))
                    $result['message'] = trans($resource_lang_key . '.message', $params);
                if (array_key_exists('code', $resource_message))
                    $result['code'] = $resource_message['code'];
                if (array_key_exists('status_code', $resource_message))
                    $result['status_code'] = $resource_message['status_code'];
            }
            else
                $result['message'] = $resource_message;
        }
        
        if ($result['status_code'] < 100 || $result['status_code'] >= 600)
            $result['status_code'] = 500;
        
        return $result;
    }
}