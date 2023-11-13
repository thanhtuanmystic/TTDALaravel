<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $target_dir = "uploads/"; // Thư mục lưu trữ ảnh
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        // echo "Tải ảnh lên thành công.";
        // echo "Đường dẫn ảnh: " . $target_file;
        $file = fopen("image_path.txt", "w");
        fwrite($file, $target_file);
        fclose($file);
        $command = escapeshellcmd('api.py');
        $output = shell_exec($command);
        $api_url = "http://127.0.0.1:5000/";
        $response = file_get_contents($api_url);
        $array = json_decode(str_replace('\\', '/', $response), true);
        if ($array !== null) {
            print_r($array);
            ?>
            <style>
                .box-img {
                    width: 100%;
                }

                .img {
                    width: 100%;
                }
            </style>
            <div>
                <img style="width: 20%" src="<?php echo $target_file; ?>" alt="">
            </div>
            <div style="display: flex; justify-content: space-between">
                <?php
                foreach ($array as $value) {
                    ?>
                    <div class="box-img">
                        <img class="img" src="<?php echo $value; ?>" alt="">
                    </div>
                    <?php
                } ?>
            </div>
            <?php
        } else {
            echo "Không thể giải mã chuỗi JSON.";
        }
    ?>
    <?php
    } else {
        echo "Lỗi khi tải ảnh lên.";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Tải ảnh lên</title>
</head>

<body>
    <form action="" method="post" enctype="multipart/form-data">
        Chọn ảnh để tải lên:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Tải lên" name="submit">
    </form>

</body>

</html>