# GPSTrackerServer
This repository contains a Server for a GPS/GSM Tracker.

## Getting started
The `config_sample.php` file has to be renamed to `config.php`. It contains all the needed settings.

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
├── doc                 # Documentation files
├── src                 # Source files
└── README.md
```

## Authors
Sebastian Damian Romero Chavero, 32303
Nils Schlegel, 32067
