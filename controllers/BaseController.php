<?php
class BaseController
{
    protected function getQueryParam($name) 
    {
        return $_GET[$name];
    }   
}
