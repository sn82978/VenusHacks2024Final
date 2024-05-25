import sqlite3

connection = sqlite3.connect('locations.db')
cur = connection.cursor()
cur.execute("SELECT * FROM Location")

rows = cur.fetchall()
for row in rows:
    print(f"var {row[1].replace(' ', '_')} = L.marker([{row[2]}, {row[3]}]).addTo(map);\nvar popup = {row[1].replace(' ', '_')}.bindPopup('Floor: {row[4]}, Stock: {'Yes!' if int(row[5]) == 1 else 'No :('}').openPopup();")

cur.close()
connection.close()