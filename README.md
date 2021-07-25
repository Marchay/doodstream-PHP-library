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

Get total & used remote upload slots
```
RUploadSlots(); // No parameters required
```

###### Remote Upload Actions

Restart Errors In Remote Upload List/Queue
```
RestartErrors(); // No parameters required
```

Clear All Errors In Remote Upload List/Queue
```
ClearErrors(); // No parameters required
```

Clear All Pending Files In Remote Upload List/Queue
```
ClearAll(); // No parameters required
```

Remove a Specific File from Remote Upload List/Queue
```
DeleteCode($file_code); // Parameters:- (Required) file_code - File code to be removed from Remote Upload List/Queue
```
###### Manage Folders

Create a folder
```
CreateFolder($name, $parent_id(Optional)); // Parameters:- 1)(Required) name - Name of the folder to be created
                                                           2)(Optional) parent_id - Parent folder ID
```

Rename a folder
```
RenameFolder($fld_id, $name); // Parameters:- 1)(Required) fld_id - Folder ID
	                                            2)(Required) name - New name of the folder
```

###### Manage Files

Get List of Videos Uploaded with info
```
List($page, $per_page, $fld_id(Optional)); // Parameters:- 1)(Required) page - Pagination , page number from which results have to shown (1 for the most recent uploads; Ascending Order followed)
	                                                         2)(Required) per_page - Max videos per page (Cannot be more than 200)
	                                                         3)(Optional) fld_id - Show videos inside a specific folder 
```

Check status of an uploaded file
```
FileStatus($file_code); // Parameters:- 1)(Required) file_code - File Code
```

Get File Info
```
FileInfo($file_code); // Parameters:- 1)(Required) file_code - File Code
```

Get file splash, single or thumbnail image
```
FileImage($file_code); // Parameters:- 1)(Required) file_code - File Code
```

Rename a file
```
FileRename($file_code, $name); //Parameters:- 1)(Required) file_code - File Code
                                              2)(Required) name - New File Name
```

Search your files
```
Search($search_term); // Parameters:- 1)(Required) search_term - Search term
```
