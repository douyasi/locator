<?php

if (!function_exists('multi_array_sort')) {

    /**
     * Array sort by order way 'desc'[Z-A] or 'asc'[A-Z].
     *
     * @param array $arr
     * @param mixed $order_by
     * @param mixed $order_way 'desc' for SORT_DESC | 'asc' for SORT_ASC
     * @param mixed $type SORT_REGULAR | SORT_NUMERIC | SORT_STRING
     * @return array
     **/
    function multi_array_sort($arr, $order_by, $order_way, $type = null)
    {

        $order_by = is_array($order_by) ? $order_by : [$order_by];
        $order_way = is_array($order_way) ? $order_way : [$order_way];

        if (!empty($type)) {
            $type = is_array($type) ? $type : [$type];
        }

        $args = [];
        foreach ($order_by as $key => $value) {
            $args[] = array_column($arr, $value);
            $args[] = $order_way[$key] == 'desc' ? SORT_DESC : SORT_ASC;
            if (!empty($type)) {
                $args[] = $type[$key];
            }
        }
        $args[] = &$arr;
        $res = call_user_func_array('array_multisort', $args);
        return $arr;
    }

}
