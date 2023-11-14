# #!/usr/bin/env python
# import pickle

# import cv2
# import numpy as np
# import tensorflow
# from flask import Flask, jsonify
# from numpy.linalg import norm
# from sklearn.neighbors import NearestNeighbors
# from tensorflow.keras.applications.resnet50 import ResNet50, preprocess_input
# from tensorflow.keras.layers import GlobalMaxPooling2D
# from tensorflow.keras.preprocessing import image

# app = Flask(__name__)
# with open('./public/AI/image_path.txt', 'r') as file:
#     image_path = file.read()


# @app.route('/', methods=['GET'])
# def hello():
#     feature_list = np.array(pickle.load(open('./public/AI/embeddings.pkl', 'rb')))
#     # filenames = pickle.load(open('filenames.pkl', 'rb'))

#     model = ResNet50(weights='imagenet', include_top=False,
#                      input_shape=(224, 224, 3))
#     model.trainable = False

#     model = tensorflow.keras.Sequential([
#         model,
#         GlobalMaxPooling2D()
#     ])

#     img = image.load_img(
#         image_path, target_size=(224, 224))
#     img_array = image.img_to_array(img)
#     expanded_img_array = np.expand_dims(img_array, axis=0)
#     preprocessed_img = preprocess_input(expanded_img_array)
#     result = model.predict(preprocessed_img).flatten()
#     normalized_result = result / norm(result)

#     neighbors = NearestNeighbors(
#         n_neighbors=6, algorithm='brute', metric='euclidean')
#     neighbors.fit(feature_list)

#     distances, indices = neighbors.kneighbors([normalized_result])
#     list_result = []
#     for item in indices[0][0:6]:
#         list_result.append(str(item))
#     return jsonify(list_result)


# if __name__ == '__main__':
#     app.run(debug=True)


#!/usr/bin/env python
import pickle
import cv2
import numpy as np
import tensorflow
from flask import Flask, jsonify
from numpy.linalg import norm
from sklearn.neighbors import NearestNeighbors
from tensorflow.keras.applications.resnet50 import ResNet50, preprocess_input
from tensorflow.keras.layers import GlobalMaxPooling2D
from tensorflow.keras.preprocessing import image
import time
import threading

app = Flask(__name__)


# Biến global để chia sẻ kết quả giữa hai luồng
api_result = []

def run_api():
    global api_result
    while True:
        with open('./public/AI/image_path.txt', 'r') as file:
            image_path = file.read()
        feature_list = np.array(pickle.load(open('./public/AI/embeddings.pkl', 'rb')))
        # filenames = pickle.load(open('filenames.pkl', 'rb'))

        model = ResNet50(weights='imagenet', include_top=False,
                         input_shape=(224, 224, 3))
        model.trainable = False

        model = tensorflow.keras.Sequential([
            model,
            GlobalMaxPooling2D()
        ])

        img = image.load_img(
            image_path, target_size=(224, 224))
        img_array = image.img_to_array(img)
        expanded_img_array = np.expand_dims(img_array, axis=0)
        preprocessed_img = preprocess_input(expanded_img_array)
        result = model.predict(preprocessed_img).flatten()
        normalized_result = result / norm(result)

        neighbors = NearestNeighbors(
            n_neighbors=6, algorithm='brute', metric='euclidean')
        neighbors.fit(feature_list)

        distances, indices = neighbors.kneighbors([normalized_result])
        list_result = []
        for item in indices[0][0:6]:
            list_result.append(str(item))
        print(list_result)  # In kết quả để kiểm tra

        # Cập nhật biến global
        api_result = list_result

        time.sleep(1)  # Chờ 1 giây trước khi chạy lại


@app.route('/', methods=['GET'])
def get_api_result():
    global api_result
    return jsonify(api_result)


if __name__ == '__main__':
    # Khởi động API trong một luồng riêng biệt
    api_thread = threading.Thread(target=run_api)
    api_thread.start()

    # Khởi động Flask để xử lý các yêu cầu HTTP
    app.run(debug=True)
