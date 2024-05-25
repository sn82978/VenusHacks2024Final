import sqlite3
import random

def add_num(c):

    c.execute("""
        SELECT COUNT(*) FROM Location
    """)
    new_id = c.fetchone()[0] + 1
    return new_id


def edit_database():
    conn = sqlite3.connect('locations.db')
    c = conn.cursor()

    c.execute("""
        INSERT INTO Location (id, bldg, floor, lat, lng, stock)
        VALUES (?, ?, ?, ?, ?, ?)
    """, (add_num(c), "Information and Computer Science 2", 1, 33.643937214202865, -117.84170092367992, 1))

    conn.commit()
    conn.close()

if __name__ == "__main__":
    edit_database()