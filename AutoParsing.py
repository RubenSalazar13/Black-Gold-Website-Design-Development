import csv
import MySQLdb

mydb = MySQLdb.connect(host='localhost',
    user='root',
    passwd='PASSWORD',
    db='Test2')
cursor = mydb.cursor()

csv_data = csv.reader(open("Desktop/Python/BG.csv"))
for row in csv_data:

    cursor.execute('INSERT INTO Vehicle(Vehicle_Make, \
          Vehicle_Year, Vehicle_Model)' \
          'VALUES("%s", "%s", "%s")', 
          row)
#close the connection to the database.
mydb.commit()
cursor.close()
print ("Done")
