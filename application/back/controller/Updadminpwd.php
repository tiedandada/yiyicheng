<?php

namespace app\back\controller;

use think\Controller;

class Updadminpwd extends Base
{
    function upd_admin_pwd(){     
        
    	return $this->fetch('form-wizard',['admin_name'=>$this->admin_name]);
    }
}
