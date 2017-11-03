#!/usr/bin/env python
import json


with open("inputSATvocab.txt", "r") as f:
	# for line in f:
	# 	print line
	out = {}
	bad_rows = "SAT Vocabulary"
	for line in f:

		if len(line) > 3 and bad_rows not in line:
			row = line.strip().split()
			# print 'keyword is: ' + row[0]
			keyword = row[0]
			definition = " ".join(row[1:])
			# print 'def is: ' + definition
			out[keyword] = definition

f.close()


with open('SATvocab.json', 'w') as fj:
    json.dump(out, fj)

    

fj.close()
