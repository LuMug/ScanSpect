# Import required modules
import cv2 as cv
import math
import argparse
import mysql.connector
from mysql.connector.locales.eng import client_error
import os 
import time
import datetime
from tkinter import *
from PIL import Image, ImageTk


#Permette di iniziare la detection dei volti.
#@param host Host del database.
#@param user user con cui connettersi.
#@param passwd password dell'utente.
def startFaceRecognition(host,user,passwd,capture=0):

    #---------- Accesso al database + dichiarazione cursore ----------------------
    mydb = mysql.connector.connect(
    host=host,
    user=user,
    passwd=passwd
    )
    cursor = mydb.cursor()
  
    #------------------------------Resize del frame-------------------------------
    
    #esegue un resizing del frame in base alla percentuale passata.
	#@param frame Frame da ridimensionare.
	#@param percent Percentuale di ridimensionamento.
    def rescale_frame(frame, percent=75):
        width = int(frame.shape[1] * percent/ 100)
        height = int(frame.shape[0] * percent/ 100)
        dim = (width, height)
        return cv.resize(frame, dim, interpolation =cv.INTER_AREA)    

    #-----------------------------------------------------------------------------


    #Permette l'aggiunta di dati al database
	#@param date Data corrente nel formato mm-dd-YY
	#@param hours Ora attuale.
	#@param minutes Minuti attuali.
	#@param secs Secondi attuali.
    def addDataToDb(date,hours,minutes,secs):

        #Inserimento dati nel Database
        print("new data added")
        cursor.execute("USE ScanSpect")
        sql = "INSERT INTO people(date,hours,minutes,seconds) VALUES(%s,%s,%s,%s)"
        val = (date,hours,minutes,secs)
        cursor.execute(sql,val)
        mydb.commit()

    #-----------------------------------------------------------------------------   
        
    #------------------------------ Scansione volti ------------------------------    

    #Genera  i box/cornici attorno ad ogni volto trovato per frame.
	#@Param frame Frame attuale.
	#@Param net Network.
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
                cv.rectangle(frameOpencvDnn, (x1, y1), (x2, y2), (255, 0, 0), int(round(frameHeight/150)), 8)
        return frameOpencvDnn, bboxes

    faceProto = "opencv_face_detector.pbtxt"
    faceModel = "opencv_face_detector_uint8.pb"

    # Load network
    faceNet = cv.dnn.readNet(faceModel, faceProto)

    #cattura dello schermo
    cap = cv.VideoCapture(capture)
    padding = 20
    last_face_number = None
    count = 0
    while cv.waitKey(1) < 0:

        #prende il frame attuale della camera.
        hasFrame, frame = cap.read()
        
        #ridimensione del frame del 200% con il metodo apposito.
        frame = rescale_frame(frame,percent=200)

        #se non individua frame, chiude.
        if not hasFrame:
            cv.waitKey()
            break

        #prende il numero di box/cornici create. Se non viene trovata nessuna, continua.
        frameFace, bboxes = getFaceBox(faceNet, frame)
        face_number = 0    

       #conteggio dei volti presenti nel frame.
        for face in bboxes:
            face_number+=1   

        #print delle cornici su schermo. 
        cv.imshow("Face detect", frameFace)
        
        #conteggio totale delle persone.
        if last_face_number is not None:
            if last_face_number < face_number:
                count+=1
                now = datetime.datetime.now()
                addDataToDb(str(datetime.date.today()),int(now.hour),int(now.minute),int(now.second))    
            last_face_number = face_number
        else:
            last_face_number = face_number
            count+=face_number
            now = datetime.datetime.now()
            addDataToDb(str(datetime.date.today()),int(now.hour),int(now.minute),int(now.second))    
        print(str(count))

    #-----------------------------------------------------------------------------    

    #chiusura della connessione con il database
    mydb.close()   

#verifica se i dati utente inseriti sono validi, per farlo utilizza un try & catch
# che verifica se l'host o l'utente inserito esistano.
#@param host Host da testare.
#@param user User da testare.
#@param password Password dell'utente da testare.
def testConnection(host,user,password):
    
    try:
        mydbTest = mysql.connector.connect(
            host=host,
            user=user,
            passwd=password
        )
        mydbTest.close()
        return True
    except (mysql.connector.errors.InterfaceError,mysql.connector.errors.ProgrammingError):
        return False

#-------------------------------- Menu Frame in Tkinter ---------------------------------------

#/////////////////// Frame /////////////////

#Definisce nuovo frame.
top = Tk()
#setta le dimensioni del frame.
top.geometry("280x380")
#setta il background bianco.
top.configure(background='white')
#aggiunge il titolo al frame.
top.wm_title("Face recognition")
#setta a non ridimensionabile il frame.
top.resizable(width=False, height=False)

#///////////////////////////////////////////


#//////////////// Logo /////////////////////
load = Image.open("logo.png")
render = ImageTk.PhotoImage(load)
img = Label(top, image=render)
img.image = render
img.place(x=30,y=20)

#///////////////////////////////////////////


#///////////// Help label //////////////////

L0 = Label(top,text="Insert your Mysql access info:")
L0.config(font=("Courier",8))
L0.place(x=30,y=90)

#///////////////////////////////////////////
#///// Host,user,password label+entry //////

L1 = Label(top, text="Host")
L1.place(x=30,y=120)
E1 = Entry(top, bd =5)
E1.insert(END, "localhost")
E1.place(x=100,y=120)

L2 = Label(top, text="User")
L2.place(x=30,y=170)
E2 = Entry(top, bd =5)
E2.place(x=100,y=170)

L3 = Label(top, text="Password")
L3.place(x=30,y=220)
E3 = Entry(top,show="*",bd =5)
E3.place(x=100,y=220)

L5 = Label(top, text="Capture ")
L5.place(x=30,y=270)
E5 = Entry(top, bd =5)
E5.insert(END,"0")
E5.place(x=100,y=270)

#///////////////////////////////////////////

#In caso venga premuto il tasto start, verifica
#che i campi non siano vuoti e che i dati inseriti
#siano validi tramite apposito metodo, se queste
#condizioni non sono soddisfatte, stampa un label rosso con l'errore.
def buttonPressed():
    v = E1.get()
    v2 = E2.get()
    v3 = E3.get()
    v4 = E5.get()

    L4 = Label()
    if L4.winfo_exists():
        L4.destroy()

    if len(v) == 0 or len(v2) == 0 or len(v3) == 0:
        L4 = Label(top, text="I campi vuoti non sono ammessi, riprova.")
        L4.config(fg="red")
        L4.place(x=30,y=350)  

    elif not v4.isdigit():
        L4 = Label(top, text="Il Capture inserito non è valido, riprova.")
        L4.config(fg="red")
        L4.place(x=30,y=350)  
        
    else:
        if testConnection(v,v2,v3) is True:
            top.destroy()
            startFaceRecognition(v,v2,v3,int(v4))
                
        else:
            L4 = Label(top, text="Utente o host inserito non valido, riprova.")
            L4.config(fg="red")
            L4.place(x=30,y=350)   

btn = Button(top, text ="Start", width=20,command=buttonPressed)
btn.place(x=60,y=320)
top.mainloop()

#----------------------------------------------------------------------------------------