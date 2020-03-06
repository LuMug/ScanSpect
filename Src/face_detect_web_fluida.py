# import libraries
import cv2
import face_recognition
from time import sleep
import datetime 

# Get a reference to webcam 
video_capture = cv2.VideoCapture(1)

#prende l'attuale dimensione del Buffer della webcam

#setta la dimensione del buffer della Webcam a 1.
video_capture.set(cv2.CAP_PROP_BUFFERSIZE,1)

a = video_capture.get(cv2.CAP_PROP_BUFFERSIZE) # CV_CAP_PROP_BUFFERSIZE
print(a)




# Initialize variables
face_locations = []
rec_time =72500 #microseconds
start_time = datetime.datetime.now()
while True:
    current_time =  datetime.datetime.now()
    delta_time = (current_time- start_time).microseconds
    # Grab a single frame of video
    ret, frame = video_capture.read()
	
    # Convert the image from BGR color (which OpenCV uses) to RGB color (which face_recognition uses)
    rgb_frame = frame[:, :, ::-1]
    if delta_time > rec_time:
        start_time=current_time
        # Find all the faces in the current frame of video
        face_locations = face_recognition.face_locations(rgb_frame)
        # Display the results	
        for top, right, bottom, left in face_locations:
            # Draw a box around the face
            cv2.rectangle(frame, (left, top), (right, bottom), (0, 0, 255), 2)

    # Display the resulting image
    cv2.imshow('Video', frame)

    # Hit 'q' on the keyboard to quit!
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Release handle to the webcam
video_capture.release()
cv2.destroyAllWindows()
