<?php
class Views
{
    public function getView($view,$data=[])
    {
        require_once ('views/'.$view.'View.php');

    }
}