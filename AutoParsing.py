import csv
import MySQLdb

#Database credentials
mydb = MySQLdb.connect(host='localhost',
    user='root',
    passwd='PASSWORD',
    db='Test2')
cursor = mydb.cursor()

#input the file that you will attempt to extract infromtation from
csv_data = csv.reader(open("Desktop/Python/BG.csv"))
for row in csv_data:

#The following has it set for three fields, but can adjust depending on fields    
    cursor.execute('INSERT INTO Vehicle(Vehicle_Make, \
          Vehicle_Year, Vehicle_Model)' \
          'VALUES("%s", "%s", "%s")', 
          row)
#close the connection to the database.
mydb.commit()
cursor.close()
print ("Done")
