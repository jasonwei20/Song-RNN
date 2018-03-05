#This code runs the files and spits out final_output.txt

#Takes in 3 parameters
#1: pop, country, or hip_hop
#2: root word (string)
#3: temperature (0-1) with 0 being more repetitive. Recommended 0.8

import sys
import enchant
import os
import string
import random

user_directory = "/Users/junhwikim/"
torch_path = "/Users/junhwikim/torch/install/bin/th"

random_string = ''.join(random.choices(string.ascii_uppercase + string.digits, k=7)) + ".wav"

#fix typos
dictionary = enchant.Dict("en_US")
def check_english(line):
	if len(line) > 3:
		words = line.split(" ")
		for word in words:
			if len(word) > 1:
				if not dictionary.check(word):
					return False
		return True

#get arguments
genre = sys.argv[1]
root = sys.argv[2]
temperature = sys.argv[3]
wav_name = sys.argv[4]

command = torch_path + " sample.lua -checkpoint cv/checkpoint_10000.t7 -length 2000 -gpu -1 -start_text " + root + " -temperature " + temperature + " > " + user_directory + "Documents/watson/first_output.txt"

if genre == "pop":
	os.chdir(user_directory + "torch/torch-rnn/")
elif genre == "country":
	os.chdir(user_directory + "torch/torch-rnn_2/")
elif genre == "hip_hop":
	os.chdir(user_directory + "torch/torch-rnn_3/")

os.system(command)
os.chdir(user_directory + "Documents/watson")

#read in text file
with open("first_output.txt") as f:
	lines = f.readlines()

#spell check and output in new text file
writer = open(user_directory + "Documents/watson/final_output.txt", "w")
writer.write(lines[0])
for i in range(1, len(lines)):
	line = lines[i]
	if check_english(line[:-2]) and len(line) > 15:
		writer.write(line)
writer.close()

with open("final_output.txt") as f2:
	clean_lines = f2.readlines()

#Clean lyrics for watson
speech_line = "".join(clean_lines).replace("\n", ", ")[:-3]

os.chdir("/Library/WebServer/Documents")
read_out_command = 'curl -X POST -u e0a7720c-ce1a-490e-864f-f19a2b6bb4f6:6IEr2OiExW1w --header "Content-Type: application/json" --header "Accept: audio/wav" --data "{\\"text\\":\\"'+speech_line+'\\"}" --output ' + wav_name + ' "https://stream.watsonplatform.net/text-to-speech/api/v1/synthesize?voice=en-GB_KateVoice";'
# Run the watson curl command
os.system(read_out_command)

#Add ";" to parse in php later 
listed_lines = []
for line in clean_lines:
	listed_lines.append(line + ";")

print("".join(listed_lines))



