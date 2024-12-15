<!DOCTYPE html>
<html>
<head>
    <title>Upload File</title>
</head>
<body>
    <h1>Upload File</h1>
    <form action="/files/upload" method="post" enctype="multipart/form-data">
        <label for="file">Choose file to upload:</label>
        <input type="file" name="file" id="file">
        <br><br>
        <button type="submit">Upload</button>
    </form>
    <br>
    <a href="/files">Back to File List</a>
</body>
</html>
