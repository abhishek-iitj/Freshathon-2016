#SCRAPPER ____________________ 14/11/2016(Final Coded)
#Just change the value of the var with the handle.
#This code will scrape the data from its users page.

#!/usr/bin/env python
import MySQLdb
import urllib2
import sys

from bs4 import BeautifulSoup

conn=MySQLdb.connect("172.16.100.161","ignus","r00t@ignus", "test")
cursor=conn.cursor()


var=sys.argv[1]
print var + "\n"

count=0
spoj="http://www.spoj.com/users/"+var
page=urllib2.urlopen(spoj)
soup=BeautifulSoup(page, "html.parser")
table=soup.find("table", class_="table table-condensed")

problem=[]



for row in table.find_all("tr"):
    for td in row.findAll('td'):
        check=td.text.encode('utf-8').strip()
        if (check!=""):
            problem.append(check)
            count+=1
            
#print count

#print cursor.rowcount
target = open("text.txt", 'w')
for i in range(0, count):
    cursor.execute("SELECT count(*) from "+var+" WHERE problems=%s", (problem[i]))
    rows=cursor.fetchone()[0]
    target.write("My name is khan\n"+var)
    target.write("\n")
    if not rows:
        qry="INSERT INTO "+var+" VALUES('"+problem[i]+"', 0)"
        cursor.execute(qry)
        target.write(qry+"\n")
    conn.commit()
target.close()   
cursor.close()
conn.close()


        
        
    
    
    
