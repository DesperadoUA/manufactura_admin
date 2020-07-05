<?php

class Router
{
    private $routes;
    public function __construct ()
    {
        $this->routes=include_once(ROOT.'/config/routes.php');
    }
    private function getURI()
    {
        $url=$_SERVER['REQUEST_URI'];
        if(substr($url, -1)!="/")
        {
            header("Location: ".$url."/", TRUE, 301); // Редирект на страницу со слешом 
            exit();                
        }

        if(!empty($_SERVER['REQUEST_URI']))
        {
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }
    public function run()
    {
        $uri=$this->getURI();
        if(strlen($uri)==2)
        {
            if(strpos($uri, 'ua') === 0 or strpos($uri, 'en') === 0)
            {
                $uri=substr($uri, 2);
            }
        }
        else
        {
            if(strpos($uri, 'ua/') === 0 or strpos($uri, 'en/') === 0)
            {
                $uri=substr($uri, 3);
            }
        }    

        foreach($this->routes as $uriPattern=>$path)
        {
            if(preg_match("~$uriPattern~", $uri))
            {
               $internalRoute=preg_replace("~$uriPattern~", $path, $uri);

               $segments=explode('/', $internalRoute);
               $controllerName=ucfirst(array_shift($segments).'Controller');
               $actionName='action'.ucfirst(array_shift($segments));

               $parameters=$segments;
               $filePath=ROOT."/controllers/".$controllerName.".php";
               if(file_exists($filePath))
               {
                
                include_once($filePath);
               }
               $controller=new $controllerName();
               $result=call_user_func_array(array($controller, $actionName), $parameters);


               if($result!=null)
               {
                   break;
               }

            }
        }
    }
}


?>