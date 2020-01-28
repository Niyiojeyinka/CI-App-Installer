# Codeigniter Web App Installer

<p>A web installer that make it easy for app end-user to easily install codeigniter 3 script without editing any source code</p>

<br>


## How to Integrate the Installer to Your CI Web APP
<ul>
	<li>replace the application/config/config.php with the config.php of the installer</li>
	<li>replace the application/config/constants.php with the constants.php of the installer</li>
	<li>repeat the above for database.php</li>
	<li>copy all files under controllers directory to your codeigniter 3 app directory</li>
	<li>copy the installer folder under views folder of this install to the views directory of your app</li>
	<li>No open the Installer.php controller in your favourite text editor and insert your SQL query string in the queries array in the next method/function of the controller</li>
	</ul>

	Check the code example below
```php
 public function next()
    {
        $this->load->database();

   
    $queries= array(

    	//example queries(you can delete this queries)
  "CREATE TABLE IF NOT EXISTS pages (
        id int(11) NOT NULL AUTO_INCREMENT,
        title varchar(128) NOT NULL,
        slug varchar(128) NOT NULL,
        author varchar(128),
        time varchar(128) NOT NULL,
        type varchar(128) NOT NULL,
        keywords varchar(225),
        description varchar(225),
        status varchar(225),
        text text NOT NULL,
       PRIMARY KEY (id)
);","CREATE TABLE IF NOT EXISTS posts (
        id int(11) NOT NULL AUTO_INCREMENT,
        title varchar(128) NOT NULL,
        slug varchar(128) NOT NULL,
        author varchar(128),
        time varchar(128) NOT NULL,
        type varchar(128) NOT NULL,
        keywords varchar(225),
        description varchar(225),
        status varchar(225),
        text text NOT NULL,
       PRIMARY KEY (id)
);"
,
"INSERT INTO ......"
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
   
```

## How to Use the Installer
<ul>
<li>visit youraddress/index.php/install/index  and fill in the input ,then click on install now button</li></ul>

