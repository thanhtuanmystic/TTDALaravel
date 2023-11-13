import os

# Thay đổi thư mục đến thư mục chứa ảnh của bạn
image_folder = "./image"

# Lấy danh sách các tệp trong thư mục
image_files = os.listdir(image_folder)

# Sắp xếp tệp theo thứ tự
image_files.sort()

# Vòng lặp để đổi tên tất cả các tệp
for i, image_file in enumerate(image_files, start=1):
    old_path = os.path.join(image_folder, image_file)
    new_name = str(i) + ".jpg"
    new_path = os.path.join(image_folder, new_name)
    os.rename(old_path, new_path)

print("Đã đổi tên thành công!")