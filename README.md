## This is a repo for my projects in web development

## Project 1: a Login routine
###	- using PHP and SQLite3, the scripts (login21.php, register.php and logout.php lay out the fundamental steps in adding a login functionality to a website (accessing the index php. 
###	- forms were designed using Bootstrap


## Project 2: playing media and uploading files
###	- here the idea was to build media (audio) player pages with increasing sophistication:
###		- player1.html plays a single song. 
###		- player2.html plays multiple files. 
###		- player3.php plays multiple files whose names are in an array. Generates the html audio tags within a loop reading the array contents.
###		- player4.php reads a text file (playlist) and populates an array then generates the html audio tags within a loop reading the array contents.
###		- player5.php reads a CSV file that contains multiple columns with additional information to the name of the song. It reads the file into an array of arrays while splitting the data to be later assigned to variables and rendered in the html playlist. 

###	- uploading files:
###		- uploadForm.html and upload.php: upload images to the target directory.
###		- uploadMP3Form.html and uploadMP3.php do the same for audio files. 

###		All html files used Bootstrap.

## Project 3: SAT Vocabulary flip cards
###	a simple page that picks random words from a vocabulary of 1000 items (inputSATvocab.txt), and shows the definition when asked. Currently using the following:  
###		- Python to clean the original text file, which in turn had been copied from a pdf (vocabTxtClean2.py), 
###		- PHP to parse the clean text file into a single string (getVocab.php),
### 		- jQuery, HTML and CSS (SATvocab01.php), where the jQuery function loadWords(url) uses the method GET to parse the data from the string above. The data is parsed into a json format (each line has a field ‘word’ and a ‘definition’). As the function iterates through the lines, it pushes each entry into the wordsArray.
###			- the functions nextWord picks a random element of the array and
### 			- the function flipCard shows the definition
### What’s next? 
### - improve interface (positions of buttons)
### - add the login routine
### - add the function ‘save to memorized’ cards, so a user can focus on the words not memorized yet
