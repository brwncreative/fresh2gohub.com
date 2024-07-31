# Convert images to Webp

from PIL import Image
import sys

print(sys.argv)
def convert_to_webp():
    img = Image.open(sys.argv[3]+sys.argv[1] + '.' + sys.argv[2])
    if(sys.argv[2] == 'png'):
        img.save(sys.argv[3]+sys.argv[1]+'.webp', 'webp', lossless=True)
        print('success')

convert_to_webp()