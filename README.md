# GPSTrackerServer
This repository contains a Server for a GPS/GSM Tracker.

## Getting started
The `config.php.sample` file has to be renamed to `config.php`. It needs to contain all the neccesary settings for a connection to an existing database. Also the file `mapsconfig.js.sample` has to be renamed to `mapsconfig.js.` and the Google maps API key has to be added there.

## General description

### Project goal
- The server receives a data packet from the GSM-module (GPRS to http). Design an appropriate interface.
- The server calculates the position from the GPS-data.
- The server calculates the position from the GSM-position data (RSSI, LAC, CID, MCC, MNC).
- The server displays the position on GoogleMaps (OpenStreetMap).
- The server sends the position data (both, with an indicator GPS/GSM) to a requesting iPhone/iPad. Design an appropriate interface.
- The server generates and stores a track.
- The server can call the GSM/GPS-tracker to wake it up and request new data. Design an appropriate interface.

### Structure
```
.
├── doc                         # Documentation files
│   ├── png                     # Folder with used pictures
│   ├── TrackerServerDoc.pdf    # Documentation Word file
│   ├── TrackerServerDoc.pdf    # Documentation PDF file
├── src                         # Source files
│   ├── caTracker.php           # Tracker class
│   ├── config.php.sample       # Database config file
│   ├── index.php               # Contains examples
│   ├── map.html                # Website structure
│   ├── mapsconfig.js.sample    # Google maps config file
│   ├── provider.php            # Data provider
│   ├── receiver.php            # Data receiver
│   ├── style.css               # Style-sheet for website
│   ├── tracker_table.sql       # Structure of a SQL tracker table
├── .gitattributes              # gitattributes
├── .gitignore                  # gitignore
├── MPC2020.pdf                 # Publication from G. Benz, and A. Siggelkow
├── ProjekteTrackerServer.pdf   # Project description
└── README.md                   # ReadMe
```

### Data
The Samples are copied from _G. Benz, and A. Siggelkow,”Implementation of a GPS and GSM module into a Zynq Z7 SoC based emulator tracking system“, MPC-WORKSHOP FEBRUAR 2020._
#### Sample 1
```
Satalite Time: 111418.0;
GPS Longidude: 47G48'29.4''N;
GPS Latitude: 9G38'43.8''E;
GSM-Localization: 5 45 1 0 E-Plus;
#MONI: N1 77 E720 E796 980 -74dbm 25 19;
#MONI: N2 70 E720 98A4 685 -75dbm 30 24;
#MONI: N3 74 E720 4B56 982 -79dbm 20 14;
#MONI: N4 36 E720 4D2E 669 -81dbm 24 18;
#MONI: N5 75 E720 9A7F 690 -82dbm 23 17;
#MONI: N6 31 E720 8B39 984 -87dbm 15 12;
```
#### Sample 2
```
Satalite Time: 0.000000;
GPS Longitude: N;
GPS Latitude: N;
GSM-Localization: #MONI: S 74 E720 9976 1022 -60dbm 45 0 1 0 E-Plus;
#MONI: N1 FF FFFF 0000 980 -76dbm -1 -1;
#MONI: N2 FF FFFF 0000 685 -79dbm -1 -1;
#MONI: N3 FF FFFF 0000 1024 -111dbm -1 -1;
#MONI: N4 FF FFFF 0000 1024 -111dbm -1 -1;
#MONI: N5 FF FFFF 0000 1024 -111dbm -1 -1;
#MONI: N6 FF FFFF 0000 1024 -111dbm -1 -1;
```
#### Structure
```
Satalite Time: float;
GPS Longditude: WGS 84;
GPS Latitude: WGS 84;
GSM-Localization: #MONI: Cell BSIC LAC CellId ARFCN Power C1 C2 (Ta RxQual PLMN)
```

### Terms
- WGS 84: World Geodetic System 1984
- TA: Timing Advance
- RxQual: Receiver Quality (depending on bit errors)
- PLMN: Public Land Mobile Network (MCC & MNC = 5 digits)
- BSIC: Base Station Identity Code (BSIC = NCC + BCC)
- LAC: Location Area Code (59168)
- CID: CellId (This is a unique id assigned to a physical cell unit.)
- ARFCN: Absolute radio-frequency channel number (for calculating frequencies http://www.cellmapper.net/arfcn)
- MCC: Mobile Country Code - 262 (Germany)
- MNC: Mobile  Code - 3 (o2 - eplus)

There are 4 basic parts of a cell identifier: MCC-MNC-LAC-CID
MCC-MNC is set by International Telecommunication Union. All telecom firms have access to this information as it is publicly available. 23
LAC-CID can be decided by the telecom firm. This is an internal decision and telecom firms don’t share this with each other

LAC:
This is decided by a telecom firm based on its own logic. Some telecom firms decide on LAC by region, others by a cluster. If a large amount of CID’s belonging to a particular telecom firm are in a particular area, all these will likely have the same LAC. This helps telecom firms organize information.

CID:
This is a unique id assigned to a physical cell unit.

Further information: https://www.rui.de/eng/nobbiglossar.html

## Authors
- Sebastian Damian Romero Chavero, 32303
- Nils Schlegel, 32067
