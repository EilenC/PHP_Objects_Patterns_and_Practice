<?php
namespace woo\base;
//...
class ApplicationRegistry extends Registry{
    private static $instance;
    private $freezedir = "data";
    private $values = [];
    private $mtimes = [];
    private function __construct()
    {
    
    }

    static function instance(){
        if(!isset(self::$instance)){self::$instance = new self();}
        return self::$instance;
    }

    protected function get($key){
        $path = $this->freezedir . DIRECTORY_SEPARATOR . $key;
        if( file_exists($path)){
            clearstatcache();
            $mtime = filemtime($path);
            if(!isset($this->mtimes[$key])){$this->mtimes[$key] = 0;}
            if($mtime > $this->mtimes[$key]){
                $data = file_get_contents($path);
                $this->mtimes[$key] = $mtime;
                return ($this->values[$key] = unserialize($data));
            }
        }
        if(isset($this->values[$key])){
            return $this->values[$key];
        }
        return null;
    }

    protected function set($key,$val){
        $this->values[$key] = $val;
        $path = $this->freezedir . DIRECTORY_SEPARATOR .$Key;
        file_put_contents($path,serialize($val));
        $this->mtimes[$key] = time();
    }

    function setDSN($dsn){
        self::instance()->set('dsn',$dsn);
    }

    function getDSN(){
        return self::instance()->get('dsn');
    }
}