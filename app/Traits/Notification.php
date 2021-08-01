<?php
namespace App\Traits; 
use CRUDBooster;

trait Notification{

    public function send_task_to_employee($id){

$config['content'] = "تم ارسال مهمة اليك 👷‍♂️";
$config['to'] = CRUDBooster::adminPath('tasks');
$config['id_cms_users'] = [$id]; //This is an array of id users
CRUDBooster::sendNotification($config);
    }
    
    public function send_done_to_manager($id){

        $config['content'] = "تم تنفيذ مهمة 👍";
        $config['to'] = CRUDBooster::adminPath('tasks');
        $config['id_cms_users'] = [$id]; //This is an array of id users
        CRUDBooster::sendNotification($config);
            }
            

}