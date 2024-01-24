# generate_dataset.py
import cv2
import numpy as np
import os


def generate_dataset(output_dir, num_samples_per_person=15):
    face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + 'haarcascade_frontalface_default.xml')
    webcam = cv2.VideoCapture(0)

    if not os.path.exists(output_dir):
        os.makedirs(output_dir)

    for person_id in range(1, 6):  # Assume 5 people for this example
        person_dir = os.path.join(output_dir, f"person_{person_id}")

        if not os.path.exists(person_dir):
            os.makedirs(person_dir)

        for sample_num in range(1, num_samples_per_person + 1):
            ret, frame = webcam.read()
            gray_frame = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)

            faces = face_cascade.detectMultiScale(gray_frame, scaleFactor=1.1, minNeighbors=5, minSize=(30, 30))

            for (x, y, w, h) in faces:
                face_roi = gray_frame[y:y+h, x:x+w]
                cv2.imwrite(os.path.join(person_dir, f"sample_{sample_num}.png"), face_roi)

            cv2.imshow('Collecting Samples', frame)
            cv2.waitKey(500)

            if sample_num == num_samples_per_person:
                # Display the last captured image
                cv2.imshow('Last Captured Image', frame)
                cv2.waitKey(0)  # Wait indefinitely until a key is pressed
                cv2.destroyAllWindows()
                return

    webcam.release()
    cv2.destroyAllWindows()

if __name__ == "__main__":
    dataset_output_dir = r"C:\xampp\htdocs\github\myworkvotingsytem\train_face\images"
    generate_dataset(dataset_output_dir)
