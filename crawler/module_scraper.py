import requests
from bs4 import BeautifulSoup
import json

study_groups = [
  '21/042/62'
]

URL = 'https://www.htw-dresden.de/studium/im-studium/aktuelle-stunden-und-raumplaene/?tx_htwddtimetable_timetable%5Baction%5D=list'

for study_group in study_groups:
  PARAMS =  { 'tx_htwddtimetable_timetable[study-group]': study_group }

  response = requests.get(
    url = URL,
    params = PARAMS
  )

  days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', '', '']
  data = {}

  html = response.text
  soup = BeautifulSoup(html, 'html.parser')
  table = soup.find('table', attrs={'class':'table timetable-table weeks bg-white'})

  if table:
    rows = table.find_all('tr')
    for row in rows:
      cols = row.find_all('td')
      cols = [ele.text.strip() for ele in cols]
      key = ''
      for i, element in enumerate(cols):
        if element:
          if element[0].isdigit():
            key = element
          else:
            data[str(key + '/' + days[i-1])] = ' '.join(element.split())
    print(json.dumps(data, sort_keys=True, indent=4))
