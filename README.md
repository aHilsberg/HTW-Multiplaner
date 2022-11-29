# Webscrapers for HTW #
### 1. Module Scraper ###
* ist bei den meisten Daten präzise, allerdings sollten alle Values die man aus Modulux bekommen kann auch daher geholt werden
  -> z.B. der Volle Modulname ist sehr schwierig zu parsen, aber eindeutig über die Modul_ID aus Modulux auslesbar

Aufruf mittels:

```
$ python3 module_scraper.py
```

Erzeugt eine

```
modules_{timestamp}.json
```

Datenstruktur

```
"{dauer} {tag}": [
  {
    "module_id": "",
    "module_short": "",
    "module_type": "",
    "opal": Bool,
    "online": Bool,
    "room": [],
    "lecturer": "",
    "turnus": "",
    "study_groups": ""
  }
]
```

* Manche Module sind kaum Parsbar (z.B. Gremienblockzeit)
* Diese haben

```
"module_id": "Spezialmodul: {id}"
```

Beispiel:

```
"17:00 - 18:30 monday": [
  {
    "module_id": "o_I268",
    "module_short": "PBO",
    "module_type": "Praktikum",
    "opal": true,
    "online": true,
    "room": [],
    "lecturer": "Freitag",
    "turnus": "w\u00f6chentlich",
    "study_groups": "19/041/01, 19/043/01, 20/041/61, 20/041/62, 20/043/61, 20/043/62, 20/043/63\u00d7"
  }
]
```

### 2. Exam Scraper ###
* Ist momentan noch in Arbeit, da die Request Response nicht alle Daten liefert
