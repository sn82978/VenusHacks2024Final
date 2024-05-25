import sqlite3

connection = sqlite3.connect('locations.db')
cur = connection.cursor()
cur.execute("SELECT * FROM Location")

all_prints = set()

rows = cur.fetchall()
for row in rows:
    all_prints.add(f"<option value={row[1]}>{row[1]}</option>")

cur.close()
connection.close()

for x in all_prints:
    print(x)