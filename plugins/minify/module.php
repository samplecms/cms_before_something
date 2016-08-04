<?php
namespace plugin\minify;
use hook;
class module{

    function init(){
            hook::add('page.end','plugin\minify\module@action');

    }

    function action(&$arg){

        $data = plugin();
        $replace = array(
            '/<!--[^\[](.*?)[^\]]-->/s' => '',
            "/<\?php/"                  => '<?php ',
            "/\n([\S])/"                => ' $1',
            "/\r/"                      => '',
            "/\n/"                      => '',
            "/\t/"                      => ' ',
            "/ +/"                      => ' ',
        );
        $data =  preg_replace(
            array_keys($replace), array_values($replace), $data
        );
        echo $data;
 
    }


}
