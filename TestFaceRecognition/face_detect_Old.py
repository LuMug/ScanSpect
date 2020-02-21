# import libraries
import cv2
import face_recognition
import time
import math

# Get a reference to webcam 
video_capture = cv2.VideoCapture(1)

def calculateLeftMovement(leftFace, areaMovement, areaFace):


# Initialize variables
face_locations = []

startTime = time.time()

last_face_locations = []
count = 0
##### 5FPS #####
while True:
    currentTime = time.time()  - startTime
    # Grab a single frame of video
    ret, frame = video_capture.read()

    # Convert the image from BGR color (which OpenCV uses) to RGB color (which face_recognition uses)
    rgb_frame = frame[:, :, ::-1]

    # Find all the faces in the current frame of video
    face_locations = face_recognition.face_locations(rgb_frame)

    face = 0

    # Display the results
    for top, right, bottom, left in face_locations:
        print('Entrato '+str(face)+' volte')
        #print('Top: '+str(top)+', Right: '+str(right)+',  Bottom: '+str(bottom)+', Left: '+str(left))
        print('Width: '+str((right - left))+', Height: '+str((bottom - top)))
        # Draw a box around the face
        cv2.rectangle(frame, (left, top), (right, bottom), (0, 0, 255), 2)
        #last_face_locations.insert(face, [])
        last_face_locations.append([])
        if last_face_locations[face]:
            if last_face_locations[face][0] != top or last_face_locations[face][1] != right or last_face_locations[face][2] != bottom or last_face_locations[face][3] != left:
                #sideControl = math.sqrt((right - left) * (bottom - top) * 100)
                #if last_face_locations[face][0] + sideControl < top + sideControl or last_face_locations[face][1] + sideControl < right + sideControl or last_face_locations[face][2] + sideControl < bottom + sideControl or last_face_locations[face][3] + sideControl < left + sideControl :
                    #count+=1
        last_face_locations[face].insert(0, top)
        last_face_locations[face].insert(1, right)
        last_face_locations[face].insert(2, bottom)
        last_face_locations[face].insert(3, left)
        print('Top misurato: '+str(top)+'\t|\t'+'Top salvato: '+str(last_face_locations[face][0])+'\nRight misurato: '+str(right)+'\t|\t'+'Right salvato: '+str(last_face_locations[face][1])+'\nBottom misurato: '+str(bottom)+'\t|\t'+'Bottom salvato: '+str(last_face_locations[face][2])+'\nLeft misurato: '+str(left)+'\t|\t'+'Left salvato: '+str(last_face_locations[face][3])+'\n')
        print('ciao '+str(face))
        face+=1
    print('\nConteggio:'+str(count)+'\n')
    print('Facce: '+str(face))
    # Display the resulting image
    cv2.imshow('Video', frame)

    # Hit 'q' on the keyboard to quit!
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Release handle to the webcam
video_capture.release()
cv2.destroyAllWindows()
