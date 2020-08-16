<?php

namespace Core;

class Request
{
    public function getParameters()
    {
        return $_GET;
    }

    public function getBody()
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
