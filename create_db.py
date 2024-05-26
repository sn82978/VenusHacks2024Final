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
    
    #c.execute("""
    #CREATE TABLE Paths(
    #id INTEGER PRIMARY KEY,
    #road TEXT ,
    #lat REAL,
    #lng REAL
    #);
    #""")

    c.execute("""
       INSERT INTO Paths (id, road, lat, lng, light)
       VALUES (?, ?, ?, ?, ?)
        """, (add_num(c), "Ring Road", 33.64424605692703, -117.84462951054087, 1))

    #c.execute("""
    #    DELETE FROM Paths    
    #    WHERE id<100;
    #          """)

    #c.execute("""
    #    ALTER TABLE Paths
    #    ADD light INTEGER;   
    #          """)

    conn.commit()
    conn.close()

if __name__ == "__main__":
    edit_database()