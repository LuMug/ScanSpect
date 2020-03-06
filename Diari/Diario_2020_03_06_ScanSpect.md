# ScanSpect | Diario di lavoro
##### André Da Silva, Alessandro Aloise, Nathan luè
### Centro Professionale Trevano, 06.03.2020

## Lavori svolti




|Orario        |Lavoro svolto                           |
|--------------|----------------------------------------|
|08:20 - 09:45 |<b>Alessandro</b>: Modifica del file README e riorganizazione di Github .<br><b>Nathan & André</b>: Lavoro sulla detection corretta dei volti.       |
|10:05 - 11:35 |<b>Tutti</b>: Lavorato sul conteggio totale dei volti.      |
|13:15 - 16:20 |<b>Tutti</b>: Lavorato sul drop dei frame e delay della webcam |
|16:20 - 16:30 |<b>Alessandro & André</b>: Stilato diario  |

##  Problemi riscontrati e soluzioni adottate

1. Il conteggio totale dei volti non funzionava correttamente.
   Per risolvere ciò, è stata adottata la seguente soluzione di <b>Alessandro</b>:

   ```
   face_number = 0
   for (x, y, w, h) in faces:
       cv2.rectangle(img, (x, y), (x+w, y+h), (255, 0, 0), 2)
       face_number+=1

   if last_face_number is not None:
       if last_face_number < face_number:
           count+=1
       last_face_number = face_number
   else:
       last_face_number = face_number
       count+=face_number

   print(str(count))

   ```
2. La Webcam presentava ancora quantità eccessive di drop dei frame e delay.
  Questo problema è stato risolto trovando un nuovo codice piu performante:

   ```
    import cv2

    # Load the cascade
    face_cascade = cv2.CascadeClassifier('haarcascade_profileface.xml')

    # To capture video from webcam.
    cap = cv2.VideoCapture(0)
    # To use a video file as input
    # cap = cv2.VideoCapture('filename.mp4')

    while True:
        # Read the frame
        _, img = cap.read()
        # Convert to grayscale
        gray = cv2.cvtColor(img, cv2.COLOR_BGR2GRAY)

        flipped = cv2.flip(gray, 1)
        faces = face_cascade.detectMultiScale(flipped, 1.3, 5)

        # Detect the faces
        #faces = face_cascade.detectMultiScale(gray, 1.1, 4)
        # Draw the rectangle around each face
        for (x, y, w, h) in faces:
            cv2.rectangle(img, (x, y), (x+w, y+h), (255, 0, 0), 2)
        # Display
        cv2.imshow('img', img)
        # Stop if escape key is pressed
        k = cv2.waitKey(30) & 0xff
        if k==27:
            break
    # Release the VideoCapture object
    cap.release()
  ```
 Un altro motivo potrebbe essere che il codice viene avviato su Virtual Machine.




##  Punto della situazione rispetto alla pianificazione

In orario.


## Programma di massima per la prossima giornata di lavoro

Trovare un dataset migliore + lavorazione sito web.
