#!C:/Users/Duhok/AppData/Local/Programs/Python/Python39/python.exe

print()
import cgi
import os 
import urllib.parse
import cv2
import glob
from vehicle_detector import VehicleDetector
########################################
sent_query = os.environ['QUERY_STRING']
query_dict = urllib.parse.parse_qs(os.environ['QUERY_STRING'])
input_name = str(query_dict['name'])[2:-2]
input_image_name = str(query_dict['image_name'])[2:-2]

vd = VehicleDetector()
images_folder = glob.glob(input_image_name)
vehicles_folder_count = 0
for img_path in images_folder:
    
    img = cv2.imread(img_path)
    vehicle_boxes = vd.detect_vehicles(img)
    vehicle_count = len(vehicle_boxes)
    vehicles_folder_count += vehicle_count
    for box in vehicle_boxes:
        x, y, w, h = box

        cv2.rectangle(img, (x, y), (x + w, y + h), (25, 0, 180), 3)

        cv2.putText(img, "Vehicles: " + str(vehicle_count), (20, 50), 0, 2, (100, 200, 0), 3)

if(vehicles_folder_count>0):
    print('''<p id="car">Car existing in the image</p>''')
else:
    print('''<p id="car">This image don't content car ,please enter image content a car !!!! </p>''')



