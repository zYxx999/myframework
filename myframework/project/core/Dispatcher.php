<?php

namespace core;

class Dispatcher
{
    public function getPage(Track $track)
    {
        $className = ucfirst($track->controller) . 'Controller';
        $fullName = "\\Project\\Controllers\\$className";

        try {
            $contoller = new $fullName;

            if(method_exists($contoller, $track->action)){
                $result = $contoller->{$track->action}($track->params);

                if($result)
                {
                    return $result;
                }else{
                    return new Page('default');
                }
            }else {
                echo "Метод <b>{$track->action}</b> не найден в классе $fullName."; die();
            }
        }catch (\Exception $error){
            echo $error->getMessage(); die();

        }
    }
}