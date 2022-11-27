import requests
from bs4 import BeautifulSoup
import json
import time
import re

# all htw dresden study groups
study_groups = [
  '19/011/KI', '19/011/VT', '19/033/61', '19/033/62', '19/037/61', '19/037/62', '19/041/01', '19/042/01', '19/043/01', '19/051/01',
  '19/051/02', '19/052/01', '19/052/02', '19/052/03', '19/053/01', '19/053/02', '19/055/01', '19/060/61', '19/060/62', '19/060/63',
  '19/060/64', '19/083/61', '19/121/01', '19/121/02', '19/121/03', '19/121/04', '19/121/05', '19/121/06', '19/121/07', '19/121/08',
  '19/121/61', '19/121/63', '19/121/65', '19/121/67', '19/124/61', '20/032/61', '20/032/62', '20/033/61', '20/033/62', '20/039/61',
  '20/039/63', '20/039/64', '20/041/61', '20/041/62', '20/042/61', '20/042/62', '20/043/61', '20/043/62', '20/043/63', '20/048/61',
  '20/071/61', '20/071/62', '20/071/63', '20/071/64', '20/072/61', '20/072/62', '20/072/63', '20/072/64', '20/124/61', '21/011/01',
  '21/011/02', '21/011/03', '21/011/04', '21/014/71', '21/015/71', '21/016/71', '21/017/61', '21/024/71', '21/024/72', '21/024/73',
  '21/024/74', '21/024/75', '21/024/76', '21/024/77', '21/024/78', '21/026/72', '21/026/73', '21/026/74', '21/026/75', '21/032/61',
  '21/032/62', '21/033/61', '21/033/62', '21/033/63', '21/037/61', '21/037/62', '21/038/71', '21/039/61', '21/039/62', '21/039/71',
  '21/039/72', '21/041/01', '21/041/61', '21/041/62', '21/042/01', '21/042/61', '21/042/62', '21/043/01', '21/043/61', '21/046/71',
  '21/046/72', '21/046/73', '21/046/74', '21/047/71', '21/047/72', '21/047/73', '21/047/74', '21/048/61', '21/051/01', '21/051/02',
  '21/052/01', '21/052/02', '21/052/03', '21/053/01', '21/055/01', '21/060/61', '21/060/63', '21/066/71', '21/071/61', '21/071/62',
  '21/071/63', '21/071/64', '21/072/61', '21/072/62', '21/072/63', '21/072/64', '21/072/71', '21/074/61', '21/074/62', '21/076/71',
  '21/081/71', '21/083/61', '21/121/01', '21/121/61', '21/124/61', '21/131/71', '21/132/71', '22/011/01', '22/011/02', '22/011/03',
  '22/011/04', '22/014/71', '22/015/71', '22/017/61', '22/024/71', '22/024/72', '22/024/73', '22/024/74', '22/024/75', '22/024/76',
  '22/024/77', '22/024/78', '22/027/71', '22/027/72', '22/027/73', '22/027/74', '22/027/75', '22/027/76', '22/027/77', '22/027/78',
  '22/028/71', '22/028/72', '22/028/73', '22/028/74', '22/028/75', '22/028/76', '22/028/77', '22/028/78', '22/032/61', '22/032/62',
  '22/033/61', '22/033/62', '22/037/61', '22/037/62', '22/039/61', '22/041/P1', '22/041/P2', '22/042/P1', '22/042/P2', '22/042/P3',
  '22/042/P4', '22/043/P1', '22/043/P2', '22/043/P3', '22/046/71', '22/046/72', '22/046/73', '22/046/74', '22/046/75', '22/048/P1',
  '22/051/01', '22/051/02', '22/052/01', '22/052/02', '22/052/03', '22/053/01', '22/055/01', '22/060/61', '22/060/62', '22/066/71',
  '22/067/71', '22/071/61', '22/071/62', '22/071/63', '22/071/64', '22/072/61', '22/072/62', '22/072/63', '22/072/64', '22/074/61',
  '22/074/62', '22/078/71', '22/083/61', '22/121/01', '22/121/61', '22/124/61', '22/130/71', '22/132/71'
]

# request URL
URL = 'https://www.htw-dresden.de/studium/im-studium/aktuelle-stunden-und-raumplaene/?tx_htwddtimetable_timetable%5Baction%5D=list'

# timetable data
days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']

data = {}
tmp_data = {}

# iterate all study groups to get all modules
for study_group in study_groups:
  PARAMS =  { 'tx_htwddtimetable_timetable[study-group]': study_group }

  response = requests.get(
    url = URL,
    params = PARAMS
  )

  # get html and initialize html parser and get table
  html = response.text
  soup = BeautifulSoup(html, 'html.parser')
  table = soup.find('table', attrs={'class':'table timetable-table weeks bg-white'})

  # for all timetables
  if table:
    rows = table.find_all('tr')
    # iterate each row and get each cell per column
    for row in rows:
      cols = row.find_all('td')

      # key used for the dictionary updated for each time
      key = ''

      # iterate each column for the time or module info
      for i, col in enumerate(cols):
        element = ' '.join(col.text.strip().split())

        # the class array at this position is the day of the module
        col_index = col.get("class", "")[1][-1]

        # if the elemente is a string ist is either the time or the module
        if element and not element[0].isdigit():
          if col_index.isdigit():

            duration = re.search('w\u00f6chentlich(.+?)Uhr', element)
            if not duration:
              duration = re.search('Ungerade Woche(.+?)Uhr', element)

            if duration:
              timestamp = ' '.join(duration.group(1).split())
              key = timestamp + ' ' + days[int(col_index)]
              if key in data:
                if element not in data[key]:
                  data[key].append(element)
              else:
                data[key] = [element]

# write data to a json file with current time stamp
with open(str('modules_' + time.strftime("%Y%m%d-%H%M%S") + '.json'), 'w') as outfile:
  json.dump(data, outfile)
