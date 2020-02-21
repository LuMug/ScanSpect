# ScanSpect | Diario di lavoro
##### André Da Silva, Alessandro Aloise, Nathan luè
### Centro Professionale Trevano, 21.02.2020

## Lavori svolti

Nota: Nathan Lue è assente, ma è riuscito a lavorare da casa.


|Orario        |Lavoro svolto                           |
|--------------|----------------------------------------|
|08:20 - 09:45 | Arricchimento contenuti diari.          |
|10:05 - 11:35 | Creazione design delle interfacce.      |
|13:15 - 16:20 | <b>Alessandro</b>: Rendere il render della web piu fluido.<br><b>Nathan & André</b>: Lavoro sulla detection corretta dei volti. |
|16:20 - 16:30 | <b>André</b>: Stilato diario  |

##  Problemi riscontrati e soluzioni adottate

- Per rendere la webcam piu fluida è stato necessario implementare una condizione che ogni x tempo faccia la detect dei volti, invece che ogni 60 frame.
- Per la dection corretta dei volti si è riusciti a fare in modo che in caso di movimento della stessa persona davanti alla webcam, il conteggio non incrementi, ma funziona solo con 1 persona al momento.

##  Punto della situazione rispetto alla pianificazione

La pianificazione è ancora rispettata.

## Programma di massima per la prossima giornata di lavoro

Risolvere il problema della detection dei volti sopra citato.
