# face_recognition.py
import cv2
import numpy as np
import os 
from sklearn import preprocessing

def train_face_recognizer(dataset_path):
    face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')
    recognizer = cv2.face.LBPHFaceRecognizer_create()

    labels = []
    faces = []
    persons = []

    for person_id, person_name in enumerate(os.listdir(dataset_path), start=1):
        person_dir = os.path.join(dataset_path, person_name)
        
        for filename in os.listdir(person_dir):
            img_path = os.path.join(person_dir, filename)
            img = cv2.imread(img_path, cv2.IMREAD_GRAYSCALE)
            
            faces.append(img)
            labels.append(person_id)
            persons.append(person_name)

    le = preprocessing.LabelEncoder()
    le.fit(persons)
    labels = le.transform(persons)

    recognizer.train(faces, np.array(labels))
    recognizer.save("face_recognizer.xml")

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
            cv2.putText(frame, f"{person_name} ({confidence_percent}%)", (x, y - 10), cv2.FONT_HERSHEY_SIMPLEX, 0.9, (0, 255, 0), 2)

        cv2.imshow('Face Recognition', frame)

        if cv2.waitKey(1) & 0xFF == ord('q'):
            break

    webcam.release()
    cv2.destroyAllWindows()

if __name__ == "__main__":
    dataset_output_dir = r"D:\onedrive\Desktop\train_face\images"
    label_encoder, face_recognizer = train_face_recognizer(dataset_output_dir)
    recognize_faces(label_encoder, face_recognizer)
