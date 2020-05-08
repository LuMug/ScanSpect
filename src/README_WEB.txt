------------------------------------------ ScanSpect README WEB ------------------------------------------

1. Spostare il contenuto della cartella localDataSite dentro una cartella a vostro piacere nel webserver.
2. Aprire il file config.php e modificare l'indirizzo affinché punti alla cartella da voiscelta.
3. Eseguire il file InitialScript.sql (tramite workbench o terminale).
4. Vengono creati creati 2 utenti nel db:
	
	User: adminUser 
	Password: !Ciao123 
	
	User: normalUser 
	Password: Normal_1

5. Utilizzare questi 2 utenti per accedere al client,   è possibile comunque utilizzare un utente a vostra 
   scelta del DBMS, basta che abbia i permessi di scrittura nel database.

6. Se si utilizza LINUX, occorre utilizzare la password mysql_native_password, deccomentare la riga apposita 
   all'interno del file InitialScript.sql


---------------------------------------------------------------------------------------------------------