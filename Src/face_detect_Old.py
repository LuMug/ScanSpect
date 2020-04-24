import cv2
import numpy as np

# Load the cascade
face_cascade = cv2.CascadeClassifier('haarcascade_frontalface_default.xml')
face_cascade2 = cv2.CascadeClassifier('haarcascade_profileface.xml')





# To capture video from webcam. 
cap = cv2.VideoCapture(0)

# To use a video file as input 
# cap = cv2.VideoCapture('filename.mp4')

last_face_number = None

count = 0

boolean = None

boolean2 = None

#cap.set(cv2.CAP_PROP_BUFFERSIZE,1)
while True:

    # Read the frame
    _, img = cap.read()

    # Convert to grayscale
    gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

    # Detect the faces
    faces = face_cascade.detectMultiScale(gray, 1.1, 4)
    faces2 = face_cascade2.detectMultiScale(gray, 1.1, 4)



    #boolean_arr = np.full((1,len(faces)), False, dtype=bool)
    #boolean_arr2 = np.full((1,len(faces2)), False, dtype=bool)

    
    boolean_arr = [False] * len(faces)
    boolean_arr2 = [False] * len(faces2)

    
    bolCounter = 0
    

    #boolean = None    
    #boolean2 = None
 
    # The number of faces seen by the webcam in a frame
    face_number = 0
		
    # Draw the rectangle around each face
    for (x, y, w, h) in faces:

        boolean_arr[bolCounter] = True
        bolCounter+=1
        #boolean = True
        cv2.rectangle(img, (x, y), (x+w, y+h), (255, 0, 0), 2)
        face_number+=1
    

    for i in range(0, len(boolean_arr)):

        if boolean_arr[i] is False:
            for (x, y, w, h) in faces2:
                cv2.rectangle(img, (x, y), (x+w, y+h), (0,255,0), 2)
                face_number+=1

    #for (x, y, w, h) in faces2:
        
        #if  boolean_arr[bolCounter] is False:
        #cv2.rectangle(img, (x, y), (x+w, y+h), (0,255,0), 2)
        #face_number+=1
        #bolCounter+=1
        
        

    #if boolean is None:
     #   boolean2 = True
      #  for (x, y, w, h) in faces2:
       #     cv2.rectangle(img, (x, y), (x+w, y+h), (0,255,0), 2)
        #    face_number+=1



   # if boolean2 is None and boolean is None:

       # flipped = cv2.flip(gray,1)
      #  faces2 = face_cascade2.detectMultiScale(flipped, 1.1, 4)
        
       # for (x, y, w, h) in faces2:
        #    cv2.rectangle(img, (x+w, y), (x+2*w, y+h), (0,0,255), 2)
         #   face_number+=1


    if last_face_number is not None:
        if last_face_number < face_number:
            count+=1
        last_face_number = face_number
    else:
        last_face_number = face_number
        count+=face_number
    
    print(str(count))

    # Display
    cv2.imshow('img', img)
    # Stop if escape key is pressed
    k = cv2.waitKey(30) & 0xff
    if k==27:
        break
		    
# Release the VideoCapture object
cap.release()