# doodstream-PHP-library
Unofficial PHP API library for Doodstream.com <br>
Minimum PHP version : 5.5


## Initializing
*doodstream.php* needs to be included into the code and initialized using the following way:- 

```
  require('doodstream.php');
  $key = "your-key-here";
  $ds = new DoodstreamAPI();
  $ds->Setup($key);
  ```

## Example Usage

```
  require('doodstream.php');
  $ds = new DoodstreamAPI();
  $key = "your-key-here";
  $ds->Setup($key);
  $uploads = $ds->List("1", "100");
  print_r($uploads);
```
Example of uploading a file using API can be found inside `example folder`


## Functions

Following are the functions supported by the library
###### Account
Get's account Information
```
AccountInfo(); // No parameters required
```
Get's report of your account (default last 7 days)
```
AccountReport($last); // Optional Parameter:- last - Get repost of last x days
```
Get's DMCA reported files list (500 results per page)
```
DMCAList(); // No parameters required
```

###### Upload
Upload Local File to DoodSteam 
```
Upload($tempfile, $type, $name); // Parameters(Required):-1) tempfile - Location of the file's temporary location on the server, called using $_FILES['video']['tmp_name']
                                                          2) type - Video Extention, called using $_FILES['video']['type'] 
                                                          3) name - Name you want to save the video with, needs to full name with extention for example :- Video1.mp4
```
###### Copy or Clone <br>
Copy / Clone your's or other's file
```
Copy($file_code, $fld_id(Optional)); // Parameters:- 1)(Required) file_code - File code of the video you want to copy
                                                     2)(Optional) fld_id - Folder ID to store inside
```

###### Remote Upload
Remote Upload (Add Link)
```
RUpload($url, $new_title(Optional)); // Parameters:- 1)(Required) url - URL to remote upload
                                                   2)(Optional) new_title - Set a custom video title
```
Get Remote Upload List/Queue
```
RUploadList(); // No parameters required
```

Get Remote Upload File Status
```
RUploadStatus($fld_id); // Parameters:- (Required) file_code - File code of the file in Remote Upload Queue
```
