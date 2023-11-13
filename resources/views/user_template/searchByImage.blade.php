<!DOCTYPE html>
<html>

<head>
    <title>Tải ảnh lên</title>
</head>

<body>
    <form action="{{route('searchbyimagehandle')}}" method="post" enctype="multipart/form-data">
        @csrf
        Chọn ảnh để tải lên:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Tải lên" name="submit">
    </form>

</body>

</html>