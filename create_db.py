import sqlite3
import random

def add_num(c):

    c.execute("""
        SELECT COUNT(*) FROM Paths
    """)
    new_id = c.fetchone()[0] + 1
    return new_id


def edit_database():
    conn = sqlite3.connect('locations.db')
    c = conn.cursor()

    c.execute("""
        INSERT INTO Paths (id, road, lat, lng, light)
        VALUES (?, ?, ?, ?, ?)
    """, (add_num(c), "Information and Computer Science 2", 33.64461288523904, -117.83670480282599, 1))

    conn.commit()
    conn.close()

if __name__ == "__main__":
    edit_database()