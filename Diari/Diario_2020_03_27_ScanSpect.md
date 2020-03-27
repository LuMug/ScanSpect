# ScanSpect | Diario di lavoro
##### André Da Silva, Alessandro Aloise, Nathan Luè
### Centro Professionale Trevano, 27.03.2020

## Lavori svolti


|Orario        |Lavoro svolto                           |
|--------------|----------------------------------------|
|08:20 - 08:40 | <b>Tutti</b>: Riunione per organizzare la giornata   |
|08:40 - 11:35 | <b>Tutti</b>: Ricerca e consulenza per definire la struttura degli "hardware" del progetto (client, WebServer)               |
|13:15 - 14:45 | <b>Tutti</b>: Ricerca di datasets per poter creare il file xml e vari test         |
|15:00 - 16:30 | <b>Nathan</b>: Documentazione<br><b>André</b>: Creazione nuovo dataset haarClassifier xml    |
|16:20 - 16:30 | <b>Alessandro</b>:   Scrittura diario.    |

##  Problemi riscontrati e soluzioni adottate

- Abbiamo avuto qualche problema nel decidere la struttura del progetto. Inizialmente abbiamo optato per Django (Web Framework) che permette di essere utilizzato sopra un WebServer. Dopo averci smanettato un po' ci siamo resi conto che Infomaniak non lo supporta.
<br>
Dopo una ricerca abbiamo provato ad utilizzare Web2Py (anch'esso un Web Framework), ma dopo un'attenta documentazione ci siamo resi conto che in realtà non era ciò che serviva a noi.
<br>
Infine abbiamo chiesto consulenza al professor Geo Petrini, che ci ha fatto ragionare su uno schema molto più semplice da capire.
<br>
Così facendo abbiamo risolto i problemi di compatibilità tra infomaniak ed il nostro applicativo.

![Schema struttura](..\Screens\schema.png)

- Abbiamo inoltre riscontrato qualche problema con la creazione dell'xml che contiene le informazioni necessarie per compiere il riconoscimento dei volti. Abbiamo bisogno di un dataset più grande di immagini per evitare di perdere "il contatto" con una faccia (in questo momento succede molto spesso). Il problema è trovarlo.

##  Punto della situazione rispetto alla pianificazione

- Corretta.

## Programma di massima per la prossima giornata di lavoro

- Iniziare a strutturare il progetto secondo lo [schema](..\Screens\schema.png) sviluppato.
- Risolvere i problemi legati al dataset troppo piccolo.
