<?php

namespace Core;

class Request
{
    public function parameters()
    {
        return $_GET;
    }

    public function body()
    {
        $data = array();

        if (count($_POST)) {
            foreach ($_POST as $key => $value) {
                $data[$key] = $value;
            }
        }

        return $data;
    }
}
