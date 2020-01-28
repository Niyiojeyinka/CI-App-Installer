<?php
/***
 * Name:       Installer
 * Package:     Install.php
 * About:        A controller that handle installation of /ci project
 * Copyright:  (C) 2020
 * Author:     Ojeyinka Philip Olaniyi
 * Twitter    @niyiojeyinka
 ***/


class Install extends CI_Controller {


      public function __construct()
      {
        parent::__construct();

        //$this->load->model(array(''));
        $this->load->helper(array('url','form_helper'));
        $this->load->library(array('form_validation','session'));


      }


  public function next()
    {
        $this->load->database();

   
    $queries= array(

//your array of sql query strings here

 );
  


 foreach($queries as $table)
 {
  if (!$this->db->query($table))
  {
   die("Error in your Queries");

  }
  }
  echo "Installation Complete <br> go  <a href='".INSTALLER_SETTING['base_url']."'>Home</a>";
}
   
  
   public function insertSetting($setting_array)
   {
     $file=__DIR__."/installer.json";
    return file_put_contents($file,json_encode($setting_array));
   }
   public function index()
   {
         
  $data['appName']="Ads Network Server by <a href='https://www.twitter.com/niyiojeyinka'>Niyiojeyinka</a>";
 /* 
$dirs = explode(DIRECTORY_SEPARATOR, __DIR__);
var_dump($dirs);
return 0;*/
$data['settings'] =INSTALLER_SETTING;

if ($data['settings']['status']!="pre") {
  
  redirect('/');
}


  $this->form_validation->set_rules("database_name","Database Name","required");
    //$this->form_validation->set_rules("database_password","Database Password","required");
  $this->form_validation->set_rules("database_host","Database Host","required");
  $this->form_validation->set_rules("database_username","Database UserName","required");
    $this->form_validation->set_rules("url","Link to your root/Domain","required");

   if (!$this->form_validation->run()) {
   
  $this->load->view('installer/index_view',$data);
}else{


$servername = $this->input->post('database_host');
$username = $this->input->post('database_username');
$password = $this->input->post('database_password');

// Create connection
$conn = new mysqli($servername, $username, $password);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS ".$this->input->post('database_name');
if ($conn->query($sql) === TRUE) {
    //echo "Database created successfully";

       $data['settings']['status'] = "post";
    $data['settings']['base_url'] = $this->input->post('url');
    $data['settings']['password'] = $this->input->post('database_password');
    $data['settings']['hostname'] = $this->input->post('database_host');
    $data['settings']['username'] = $this->input->post('database_username');
    $data['settings']['database'] = $this->input->post('database_name');


    $this->insertSetting($data['settings']);
    redirect('/Install/next');
} else {
    echo "Error creating database: " . $conn->error;
}

$conn->close();
  
}

   }
}
