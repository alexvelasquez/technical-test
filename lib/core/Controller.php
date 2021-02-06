<?php

class Controller
{
    function __construct()
    {
        $this->views = new Views(); /** load views */
    }

    /** load model by parameter*/
    public function loadModel($model)
    {
        require_once('model/'.$model.'.php');
        return (new $model());
    }

    public function validateForm($values){
        foreach ($values as $value) {
            if(empty($value)){
                return false;
            }
        }
        return true;
    }
    public function jsonResponse($code,$values)
    {
        $data['code'] = $code;
        $data[ ($code !== 200) ? 'error' : 'data'] = $values;
        echo json_encode($data);die;
    }

}