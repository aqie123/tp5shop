<?php
/**
 * 自定义show方法
 * @param $status
 * @param string $message
 * @param array $data
 * @return array
 */
function show($status, $message='' , $data=[]) {
    return [
        'status' => intval($status),
        'message' => $message,
        'data' => $data,
    ];
}