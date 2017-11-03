#!/usr/bin/env python
import json

inputFilename = "inputSATvocab.txt"
outputFilename = 'SATvocab.txt'
bad_rows = "SAT Vocabulary"


# delete previous contents
open(outputFilename, 'w').close()


with open(inputFilename) as f:
	for line in f:
		if len(line) > 15 and bad_rows not in line:
			row = line.strip().split()
			# print 'keyword is: ' + row[0]
			keyword = row[0]
			definition = " ".join(row[1:])
			# print 'def is: ' + definition

			out = { "word": keyword, "definition": definition }
			with open(outputFilename, 'a') as fj:
				fj.write(json.dumps(out)+"\n")

