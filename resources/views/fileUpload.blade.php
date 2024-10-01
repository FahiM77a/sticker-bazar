@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <!-- File Upload Form on the Left -->
        <div class="col-md-6 mt-5">
            <div class="card text-center">
                <div class="card-header">
                    <h5>Upload your files</h5>
                </div>

                <div class="card-body p-3">
                    <!-- Title Input Field -->
                    <input class="form-control my-2" type="text" id="titleId" placeholder="Enter file title" required>
                    <!-- File Input Field -->
                    <input class="form-control my-2" type="file" id="fileId" required>
                    <!-- Upload Button -->
                    <button onclick="onUpload()" class="btn btn-primary" id="uploadBtnId">Upload</button>
                    <h2 id="uploadPercentage"></h2>
                </div>
            </div>
        </div>

        <!-- File List Table on the Right -->
        <div class="col-md-6 mt-5">
            <div class="card text-center">
                <div class="card-header">
                    <h5>Uploaded Files</h5>
                </div>
                <div class="card-body p-3">
                    <!-- Search Field -->
                    <input class="form-control my-2" type="text" id="searchQuery" placeholder="Search by title">
                    <button onclick="searchFiles()" class="btn btn-primary">Search</button>
                    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="fileTableBody">
                            <!-- Uploaded files will be appended here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('script')
    <script type="text/javascript">

        // getFileList();
        function getFileList() {
            axios.get('/fileList')
            .then(response => {
                var JSONDATA = response.data;
                //$('#fileTableBody').empty(); // Clear previous entries


                // Loop through the JSON data and append rows to the table
                $.each(JSONDATA, function(i) {
                    $('<tr>').html(
                        "<td>" + JSONDATA[i].id + "</td> " +
                        "<td>" + JSONDATA[i].title + "</td> " +
                        "<td><a href='/fileDownload/"+JSONDATA[i].file_path+"' class='btn btn-primary'>Download</a></td>"
                    ).appendTo('#fileTableBody');
                });

                // $('.downloadBtn').click(function(){
                //     let file_path = $(this).data('path');
                //     alert(file_path);
                // })
                
            })
            .catch(error => {
                console.error("Error fetching file list:", error);
            });
        }

        function searchFiles() {
            let searchQuery = document.getElementById("searchQuery").value; // Get the search input value

            axios.get('/fileList', {
                params: {
                    search: searchQuery // Pass the search query as a parameter
                }
            })
            .then(response => {
                var JSONDATA = response.data;
                $('#fileTableBody').empty(); // Clear previous entries

                // Loop through the JSON data and append rows to the table
                $.each(JSONDATA, function(i) {
                    $('<tr>').html(
                        "<td>" + JSONDATA[i].id + "</td> " +
                        "<td>" + JSONDATA[i].title + "</td> " +
                        "<td><a href='/fileDownload/"+JSONDATA[i].file_path+"' class='btn btn-primary'>Download</a></td>"
                    ).appendTo('#fileTableBody');
                });
            })
            .catch(error => {
                console.error("Error fetching file list:", error);
            });
        }


        function onUpload() {
            // Your upload logic here
            let title = document.getElementById("titleId").value;
            let myFile = document.getElementById("fileId").files[0];
            let myFileName = myFile.name;
            let fileExe = myFileName.split('.').pop()
            // let myFileSize = myFile.size;
            // let myFileSizeMB = (myFileSize / (1024 * 1024)).toFixed(2);
            // alert(myFileSizeMB);

            // if (!myFile) {
            //     alert("Please select a file to upload.");
            //     return;
            // }

            let fileData = new FormData();
            fileData.append('FileKey', myFile);
            fileData.append('title', title); // Append the title to the FormData
            

            let config = {
                headers: {
                    'Content-Type': 'multipart/form-data'
                },
                onUploadProgress:function (progressEvent) {
                        var uploadPercentage = Math.round((progressEvent.loaded*100)/progressEvent.total)
                        // console.log(uploadPercentage);
                        
                        $('#uploadPercentage').html(uploadPercentage+" %");
                    }
            };

            let url = '/fileUp';

            axios.post(url,fileData,config)
            .then(response => {
                if(response.status == 200) {
                    $('#uploadPercentage').html("File uploaded successfully!");
                    
                    // Reset input fields
                    document.getElementById("titleId").value = ""; // Clear the title input
                    document.getElementById("fileId").value = ""; // Clear the file input

                    setTimeout(function () {
                        $('#uploadPercentage').html(" ");
                    },2000)
                }
                else {
                     $('#uploadPercentage').html("File upload failed");

                    setTimeout(function () {
                        $('#uploadPercentage').html(" ");
                    },2000)
                }
                
            })
            .catch(error => {
                $('#uploadPercentage').html("File upload failed");
                    setTimeout(function () {
                        $('#uploadPercentage').html(" ");
                    },2000)
            });
        }

        // Fetch the file list when the page loads
        document.addEventListener('DOMContentLoaded', getFileList);
    </script>
@endsection


