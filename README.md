# Piscine_comunali

Progettazione e realizzazione dell’applicazione web “gestione di piscine comunali”
Corso di Basi di Dati e Web A.A. 2020/2021

# Introduzione
Scopo del lavoro. Scopo di questo progetto è la realizzazione di una versione semplificata per la gestione di piscine comunali per un comune di medie/grandi dimensioni.
Gruppo di lavoro. Il progetto deve essere svolto singolarmente.
Nota 1. Nel seguito viene descritto in maniera informale il dominio applicativo di interesse. Si sottolinea che, come in genere avviene nei casi reali, la specifica può non essere completa e può presentare contraddizioni e/o ambiguità. È compito del progettista individuare eventuali punti critici, analizzarli e proporre soluzioni progettuali congruenti con l’intero sviluppo del progetto.
Nota 2. Porre particolare attenzione ai dati che necessariamente debbono essere inseriti nella base di dati rispetto a quelli che sono calcolabili a partire da questi. Si rammenta che a livello di interfaccia è sempre possibile gestire adeguatamente il flusso dei dati.
Aggiornamenti. Potrebbero essere rilasciati aggiornamenti del presente documento (si veda “versione documento” in alto nella pagina). È compito degli studenti verificare periodicamente, ed in particolare prima della consegna per l’esame, la presenza di nuove versioni. Le nuove versioni generalmente riportano chiarimenti o piccole modifiche alla descrizione.

#  Descrizione del dominio applicativo
Scopo di questo progetto è la realizzazione di una versione semplificata per la gestione di piscine comunali per un comune di medie/grandi dimensioni. Per ciascuna piscina, identificata dal nome, si vogliono memorizzare l’indirizzo, un insieme di numeri di telefono, il periodo di apertura, informazioni sulla struttura qualinumero e tipologia di vasche (all’aperto, al chiuso, olimpioniche, nuoto baby, nuoto neonatale), numero di corsie per le vasche che possono essere divise in corsie, periodo di fruizione ed infine i dati del responsabile. Si noti che un responsabile potrebbe “dirigere” anche più di una piscina nel qual caso interessa sapere quando è reperibile in ciascuna struttura di cui è responsabile.
Il comune propone dei corsi di nuoto (nuoto baby, ragazzi, adulti, ciascuno con numero di livelli da I a III) attivati in tutte le strutture, eventualmente con modalità ed orari differenti; Resta a ciascuna struttura la facoltà di proporre alla propria utenza dei corsi specifici. Alcuni corsi (nuoto baby e neonatale) possono essere invece attivati esclusivamente nelle strutture con le apposite vasche. Per ogni corso svolto preso una struttura si vogliono memorizzare alcune informazioni: il costo, il numero minimo e massimo di partecipanti, l’orario di svolgimento delle varie edizioni, e l’eventuale corsia nel quale si tiene).
Gli istruttori possono essere assunti stabilmente dalle strutture, nel qual caso interessa memorizzare il numero di giorni di ferie disponibili, o possono essere soggetti a contratti stagionali di durata annuale o una frazione di esso; di ciascun istruttore interessano i dati anagrafici, i recapiti telefonici e l’elenco delle qualifiche possedute (ad es. istruttore di nuoto, di fitness, di pallanuoto, ecc.). Si vuole tenere traccia della storia lavorativa degli istruttori; si noti che un istruttore può aver lavorato/lavorare in più strutture ma anche può aver sostituito il collega “titolare” più volte nello stesso anno (ovviamente in periodi differenti).
Ogni istruttore può seguire più edizioni dello stesso corso o di corsi differenti. Le persone iscritte ad una qualche edizione di un corso, anche più di una, debbono essere registrate e identificate dal numero della tessera personale rilasciata in fase di iscrizione. Per poter frequentare è obbligatorio il rilascio di un certificato medico, di durata stagionale, che attesti l’idoneità alla pratica sportiva. Si vuole mantenere le informazioni dei medici che hanno rilasciato i certificati, della data della visita e degli iscritti che siano sprovvisti dello stesso.
Di seguito vengono riportate alcune operazioni da considerare durante la progettazione della base di dati. Questo elenco non è esaustivo, è possibile considerare anche altre operazioni oltre a quelle indicate, motivandone la scelta.

1) Inserimento e modifica
a. Di una struttura
b. Del personale in organico nella struttura (per un determinato “anno scolastico”)
c. Dei corsi presenti nella struttura
d. Degli iscritti, se minorenni, anche del/dei relativo/i genitore/i (almenouno)

2) Visualizzazione
a. Del personale in organico per dato anno e struttura
b. Dello storico delle iscrizioni di un iscritto in una struttura 

3) Interrogazioni
a. Determinare gli istruttori supplenti che hanno esattamente una supplenza nella stagione corrente
b. Determinare gli istruttori supplenti che hanno almeno due supplenze nella stagione corrente
c. Determinare gli istruttori supplenti che hanno non più di due supplenze nella stagione corrente

Svolgimento del progetto
Progettazione e implementazione della base di dati
1) Si definisca lo schema Entità-Relazione per la base di dati, evidenziando le entità e le associazioni di interesse, nonché eventuali vincoli di cardinalità e di identificazione, motivando le scelte effettuate. Altri eventuali vincoli devono essere espressi in linguaggio naturale.
2) Si effettui la traduzione dello schema E-R in uno schema E-R ristrutturato equivalente, motivando le eventuali scelte effettuate.
3) Si effettui la traduzione dello schema E-R ristrutturato in un equivalente schema relazionale. Si discutano eventuali ottimizzazioni dello schema.
4) Si riporti esplicitamente il codice SQL standard dei comandi di creazione delle tabelle e delle interrogazioni richieste al punto 3 (Interrogazioni).
5) Fornire un file txt con gli script per la creazione delle strutture della base di dati in accordo allo schema relazionale ottenuto alla fine dalla fase di progettazione. La base di dati creata dovrà essere popolata con tutte le informazioni che si ritengono necessarie per una simulazione realistica. Inoltre, si dovranno fornire dati sufficienti almeno a verificare che i vincoli di dominio espressi siano verificati e che in generale le operazioni di cui si richiede l’implementazione funzionino correttamente.
