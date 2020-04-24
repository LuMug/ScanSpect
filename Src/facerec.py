# Import required modules
import cv2 as cv
import math
import time
import argparse
import mysql.connector
import os 


#---------- Accesso al database + dichiarazione cursore ----------------------
mydb = mysql.connector.connect(
host="localhost",
user="root",
passwd="root"
)
cursor = mydb.cursor()
#-----------------------------------------------------------------------------


def createDatabase():

    cursor.execute("SHOW DATABASES LIKE 'ScanSpect'")
    results = 0
    for x in cursor:
        results+=1
    if results == 0:
        cursor.execute("DROP DATABASE IF EXISTS ScanSpect")
        cursor.execute("CREATE DATABASE ScanSpect")
        cursor.execute("USE ScanSpect")
        cursor.execute("DROP TABLE IF EXISTS persone")
        cursor.execute("CREATE TABLE persone (ora date,persone INTEGER(32))")
        mydb.commit()


def addDataToDb(date,nPersons):

    #Inserimento dati nel Database
    cursor.execute("USE ScanSpect")
    sql = "INSERT INTO persone(ora,persone) VALUES (%s,%s)"
    val = (date,nPersons)
    cursor.execute(sql,val)
    mydb.commit()
    mydb.close()
    

def getFaceBox(net, frame, conf_threshold=0.7):
    frameOpencvDnn = frame.copy()
    frameHeight = frameOpencvDnn.shape[0]
    frameWidth = frameOpencvDnn.shape[1]
    blob = cv.dnn.blobFromImage(frameOpencvDnn, 1.0, (300, 300), [104, 117, 123], True, False)

    net.setInput(blob)
    detections = net.forward()
    bboxes = []
    for i in range(detections.shape[2]):
        confidence = detections[0, 0, i, 2]
        if confidence > conf_threshold:
            x1 = int(detections[0, 0, i, 3] * frameWidth)
            y1 = int(detections[0, 0, i, 4] * frameHeight)
            x2 = int(detections[0, 0, i, 5] * frameWidth)
            y2 = int(detections[0, 0, i, 6] * frameHeight)
            bboxes.append([x1, y1, x2, y2])
            cv.rectangle(frameOpencvDnn, (x1, y1), (x2, y2), (0, 255, 0), int(round(frameHeight/150)), 8)
    return frameOpencvDnn, bboxes


faceProto = "opencv_face_detector.pbtxt"
faceModel = "opencv_face_detector_uint8.pb"

MODEL_MEAN_VALUES = (78.4263377603, 87.7689143744, 114.895847746)

# Load network
faceNet = cv.dnn.readNet(faceModel, faceProto)

# Open a video file or an image file or a camera stream
cap = cv.VideoCapture(0)
padding = 20
last_face_number = None
count = 0

while cv.waitKey(1) < 0:
    # Read frame
    #t = time.time()
    hasFrame, frame = cap.read()
    if not hasFrame:
        cv.waitKey()
        break

    frameFace, bboxes = getFaceBox(faceNet, frame)
    if not bboxes:
        print("Nessuna faccia trovata.")
        continue
    
    face_number = 0
    for bbox in bboxes:
        # print(bbox)
        face = frame[max(0,bbox[1]-padding):min(bbox[3]+padding,frame.shape[0]-1),max(0,bbox[0]-padding):min(bbox[2]+padding, frame.shape[1]-1)]
        blob = cv.dnn.blobFromImage(face, 1.0, (227, 227), MODEL_MEAN_VALUES, swapRB=False)
        face_number+=1   
        cv.imshow("Face detect", frameFace)
       
    if last_face_number is not None:
        if last_face_number < face_number:
            count+=1
            #addData()
        last_face_number = face_number
    else:
        last_face_number = face_number
        count+=face_number 
           
    print(str(count))  
