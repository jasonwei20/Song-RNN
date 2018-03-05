from urllib.request import urlopen
from bs4 import BeautifulSoup, NavigableString, Tag
from datetime import datetime
import enchant
genres = ['Pop', 'Country', 'Electronic']
letters = list('ABC')#HIJKLMNOPQRSTUVWXYZ')

# for genre in genres:
genre = 'Hip_Hop'
output_file = genre + ".txt"
song_links = []
root = "http://lyrics.wikia.com/wiki/Category:Genre/" + genre + "?from="
for letter in letters:
	page_link = root + letter
	print(page_link)
	page = urlopen(page_link)
	soup = BeautifulSoup(page, 'html.parser')
	links = soup.find('link', attrs={'class': 'href'})

	artists = []
	for link in soup.find_all('a', href=True):
	    if '/wiki/' + letter in link['href']:
	        clean = link['href'].replace('/wiki/', "")
	        if '/' not in clean and 'Category:' not in clean:
	            artists.append(clean)
	#print(artists) #all artists in a certain genre that start with a certain letter

	def generate_song_links(artists):
		for artist in artists:
		    pg = "http://lyrics.wikia.com/wiki/" + artist
		    #print("scraping", pg)
		    page = urlopen(pg)
		    soup = BeautifulSoup(page, 'html.parser')
		    links = soup.find('link', attrs={'class': 'href'})
		    for link in soup.find_all('a', href=True):
		        if artist + ":" in link['href']:
		            song_links.append("http://lyrics.wikia.com/" + link['href'])

	generate_song_links(artists)

	print("Done generating song links")

	f = open(output_file, "w")

	dictionary = enchant.Dict("en_US")

	def check_english(line):
		words = line.split(" ")
		for word in words:
			if not dictionary.check(word):
				return False
		return True



#data = []               
#write to file
for pg in song_links:
    try:
        page = urlopen(pg)
        soup = BeautifulSoup(page, 'html.parser')
        lyric_box = soup.find('div', attrs={'class': 'lyricbox'})

        for br in lyric_box.findAll('br'):
            next = br.previousSibling

            if not (next and isinstance(next, NavigableString)):
                continue

            next_2 = next.nextSibling

            if next_2 and isinstance(next_2, Tag) and next_2.name == 'br':
                text = str(next.strip())
                if text:
                	if len(text) > 20 and check_english(text):
                		f.write(text)
                		f.write("\n")
                		#print(text)
                	#data.append(text)
        #data.append("")
        #print("Added song from", page)
    except:
        print("There was an error.")

# print("Writing to file...")
# f = open(output_file, "w")

# for line in data:
#     if len(line) > 20 and dictionary.check(line):
#         f.write(line)
#         f.write("\n")
f.close()







