import cv2
import numpy as np
import os
from sklearn import preprocessing
from generate_dataset import generate_dataset, show_message
import subprocess

def train_face_recognizer(dataset_path, target_size=(100, 100)):
    face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')
    recognizer = cv2.face.LBPHFaceRecognizer_create()

    labels = []
    faces = []
    persons = []

    le = preprocessing.LabelEncoder()  # Instantiate LabelEncoder here

    for person_id, person_name in enumerate(os.listdir(dataset_path), start=1):
        person_dir = os.path.join(dataset_path, person_name)

        for filename in os.listdir(person_dir):
            img_path = os.path.join(person_dir, filename)
            img = cv2.imread(img_path, cv2.IMREAD_GRAYSCALE)

            if img is not None:
                # Resize the image to the target size
                img = cv2.resize(img, target_size)

                faces.append(img)
                labels.append(person_id)
                persons.append(person_name)

    print("Number of loaded images:", len(faces))  # Print the number of loaded images

    if len(faces) == 0:
        print("No images loaded. Exiting.")
        return None, None

    # Convert labels to integers before transforming with LabelEncoder
    labels = le.fit_transform(list(map(str, labels)))

    recognizer.train(faces, np.array(labels))
    recognizer.save("face_recognizer.xml")

    print("Training completed successfully.")
    return le, recognizer

def recognize_faces(le, recognizer):
    face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')
    webcam = cv2.VideoCapture(0)

    while True:
        ret, frame = webcam.read()
        gray_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)

        faces = face_cascade.detectMultiScale(gray_frame, scaleFactor=1.1, minNeighbors=5, minSize=(30, 30))

        for (x, y, w, h) in faces:
            face_roi = gray_frame[y:y+h, x:x+w]
            label, confidence = recognizer.predict(face_roi)

            person_name = le.inverse_transform([label])[0]
            confidence_percent = int(100 * (1 - confidence / 300))

            cv2.rectangle(frame, (x, y), (x + w, y + h), (0, 255, 0), 2)
            text = f"{person_name} ({confidence_percent}%)"
            cv2.putText(frame, text, (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.9, (0, 255, 0), 2)

            # Check confidence level and open PHP file if needed
            if 70 <= confidence_percent <= 100:
                php_file_path = r"C:\xampp\htdocs\github\myworkvotingsytem\voting.php"
                subprocess.run(["php", php_file_path])

        cv2.imshow('Face Recognition', frame)

        if cv2.waitKey(1) & 0xFF == ord('q'):
            break

    webcam.release()
    cv2.destroyAllWindows()

if __name__ == "__main__":
    dataset_output_dir = r"C:\xampp\htdocs\github\myworkvotingsytem\train_face\images"
    generate_dataset.show_message = show_message  # Assign the function to the imported show_message
    label_encoder, face_recognizer = train_face_recognizer(dataset_output_dir)
    recognize_faces(label_encoder, face_recognizer)
