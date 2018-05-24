'''
spider program to download images from https://e.thenews.com.pk/ 

http://e.thenews.com.pk/lahore/11-5-2017/mainpage/page1.jpg
http://e.thenews.com.pk/lahore/11-5-2017/mainpage/page21.gif

'''

import requests
import sys
import os
import sys, os,  json
from PIL import Image, ImageFont, ImageDraw
from PIL.ExifTags import TAGS
import requests
from io import BytesIO
from os import listdir
from os.path import isfile, join

date = input('date(format 11-5-2017): ')
p = int(input('number of pages you want to download: '))

e = 0
extensions = [ '.gif', '.jpg', '.jpeg', '.tiff', '.png', '.bmp']
ext = extensions[e]

root_dir = '/Users/marilenedacosta/Dropbox/html/spidNews'+str(date)
if os.path.isdir(root_dir) != True:
	os.makedirs(root_dir)


for i in range(1, p):
	file_url = str('http://e.thenews.com.pk/lahore/'+str(date)+'/mainpage/page'+str(i)+ext)
	r = requests.get(file_url)
	if request.status_code == 200:
    	print('downloading page' +str(i))
    	im = Image.open(BytesIO(r.content))
		im.save(root_dir+"/"+str(date)+"page" +str(i)+".gif")
	
	else:
		e += 1
    	ext = extensions[e]
		continue

print("Pages saved on " +root_dir+ ":")
page_files = [f for f in listdir(root_dir) if isfile(join(root_dir, f))]
for page in page_files:
	print (page)



