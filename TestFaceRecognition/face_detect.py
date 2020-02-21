# import libraries
import cv2
import face_recognition
import math

# Get a reference to webcam 
video_capture = cv2.VideoCapture(0)

# Calculate left or top coords of the movement square
def calculateLeftOrTopMovement(leftOrTopFace, areaMovement, areaFace):
    return leftOrTopFace - 1/2 * math.sqrt(areaMovement) + 1/2 * math.sqrt(areaFace)

# Initialize variables
face_locations = []

# It contains the last location of the faces.
last_face_locations = []

last_movement_locations = []

# The number of peoples that appear in front of the camera
count = 0

# How large is the movement area compared to the face area. By default is 8 times bigger.
rateo = 8

# The number of faces in the last frame
lastFaces = 0

##### 5FPS #####
while True:
    
    # Grab a single frame of video
    ret, frame = video_capture.read()

    # Convert the image from BGR color (which OpenCV uses) to RGB color (which face_recognition uses)
    rgb_frame = frame[:, :, ::-1]

    # Find all the faces in the current frame of video
    face_locations = face_recognition.face_locations(rgb_frame)

    # The number of faces seen by the webcam in a frame
    face = 0

    # Runs the cycle for the number of faces detected
    for top, right, bottom, left in face_locations:
        
        #Debugging (print coords of square face, width and height of the square)
        print('Entrato '+str(face)+' volte')
        print('Top: '+str(top)+', Right: '+str(right)+',  Bottom: '+str(bottom)+', Left: '+str(left))
        print('Width: '+str((right - left))+', Height: '+str((bottom - top)))
        
        # Draw a box around the face
        cv2.rectangle(frame, (left, top), (right, bottom), (0, 0, 255), 2)
        
        # It add a new last face location
        last_face_locations.append([])

        # It add a new last movement location
        last_movement_locations.append([])

        # It check if already exists a last face location of the current face
        if last_face_locations[face]:

            # If it exists, check that it is not in the same position as the previous frame
            if last_face_locations[face][0] != top or last_face_locations[face][1] != right or last_face_locations[face][2] != bottom or last_face_locations[face][3] != left:

                # If it is not in the same position it calculates the dimensions and coordinates of the points of the movement square, it also draws it on the screen
                areaMovement = (right - left) * (bottom - top) * rateo
                areaFace = (right - left) * (bottom - top)
                leftMovement = calculateLeftOrTopMovement(left, areaMovement, areaFace)
                rightMovement = leftMovement + math.sqrt(areaMovement)
                topMovement = calculateLeftOrTopMovement(top, areaMovement, areaFace)
                bottomMovement = topMovement + math.sqrt(areaMovement)
                cv2.rectangle(frame, (int(leftMovement), int(topMovement)), (int(rightMovement), int(bottomMovement)), (0, 0, 255), 2)

                # It check if already exists a last face movement location of the current face, else if not exists it add 1 to count
                if last_movement_locations[face]:
                
                    # Debugging (print coords movement and last coords movement)
                    print('TopMovement misurato: '+str(topMovement)+'\t|\t'+'TopMovement salvato: '+str(last_movement_locations[face][0])+'\nRightMovement misurato: '+str(rightMovement)+'\t|\t'+'RightMovement salvato: '+str(last_movement_locations[face][1])+'\nBottomMovement misurato: '+str(bottomMovement)+'\t|\t'+'BottomMovement salvato: '+str(last_movement_locations[face][2])+'\nLeftMovement misurato: '+str(leftMovement)+'\t|\t'+'LeftMovement salvato: '+str(last_movement_locations[face][3])+'\n')
                    
                    # If the face is out from the movement squadre, it add 1 to count
                    if top < last_movement_locations[face][0] or right > last_movement_locations[face][1] or bottom > last_movement_locations[face][2] or left < last_movement_locations[face][3]:
                        count+=1
                elif not last_movement_locations[face]:
                    count+=1
                
                # Inserts the coordinates of the current face movement in the list of last face locations
                last_movement_locations[face].insert(0, topMovement)
                last_movement_locations[face].insert(1, rightMovement)
                last_movement_locations[face].insert(2, bottomMovement)
                last_movement_locations[face].insert(3, leftMovement)
        
        # Inserts the coordinates of the current face in the list of last face locations
        last_face_locations[face].insert(0, top)
        last_face_locations[face].insert(1, right)
        last_face_locations[face].insert(2, bottom)
        last_face_locations[face].insert(3, left)

        # Debugging (print coords and last coords)
        print('Top misurato: '+str(top)+'\t|\t'+'Top salvato: '+str(last_face_locations[face][0])+'\nRight misurato: '+str(right)+'\t|\t'+'Right salvato: '+str(last_face_locations[face][1])+'\nBottom misurato: '+str(bottom)+'\t|\t'+'Bottom salvato: '+str(last_face_locations[face][2])+'\nLeft misurato: '+str(left)+'\t|\t'+'Left salvato: '+str(last_face_locations[face][3])+'\n')
        

        # Increase the value of face for the next cycle
        face+=1

    # If the faces in the current frame are more than in the last frame it cleans last movement locations and last face locations
    if lastFaces < face:
        last_movement_locations.clear()
        last_face_locations.clear()
    
    # Set lastFaces equals the number of faces in the current frame
    lastFaces = face

    # Debugging (print number of total faces)
    print('\nConteggio:'+str(count)+'\n')

    # Debugging (print number of faces in camera)
    print('Facce: '+str(face))

    # Display the resulting image
    cv2.imshow('Video', frame)

    # Hit 'q' on the keyboard to quit!
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Release handle to the webcam
video_capture.release()
cv2.destroyAllWindows()
